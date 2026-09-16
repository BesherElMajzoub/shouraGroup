<?php

namespace Tests\Feature;

use App\Mail\NewJobApplication;
use App\Models\JobApplication;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class CareerApplicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_application_is_saved_privately_and_emailed_to_hr(): void
    {
        Storage::fake('local');
        Mail::fake();
        Setting::create([
            'key' => 'hr_email',
            'value' => 'hr@shorabrothers.com',
            'group' => 'contact',
        ]);

        $response = $this->post(route('careers.store'), [
            'full_name' => 'محمد أحمد خالد',
            'phone' => '0999999999',
            'email' => 'applicant@example.com',
            'cv' => UploadedFile::fake()->create('resume.pdf', 120, 'application/pdf'),
        ], ['Accept' => 'application/json']);

        $response->assertOk()->assertJson([
            'ok' => true,
            'email_sent' => true,
        ]);

        $application = JobApplication::sole();
        $this->assertSame('Open Application', $application->department);
        $this->assertSame('Not Specified', $application->preferred_branch);
        Storage::disk('local')->assertExists($application->cv_path);
        Storage::disk('public')->assertMissing($application->cv_path);

        $sentMail = null;
        Mail::assertSent(NewJobApplication::class, function (NewJobApplication $mail) use ($application, &$sentMail) {
            $sentMail = $mail;

            return $mail->hasTo('hr@shorabrothers.com') && $mail->application->is($application);
        });
        $safeName = Str::slug($application->full_name) ?: 'applicant';
        $extension = pathinfo($application->cv_path, PATHINFO_EXTENSION);
        $sentMail->assertHasAttachment(
            Attachment::fromStorageDisk('local', $application->cv_path)
                ->as("CV-{$safeName}.{$extension}"),
        );
    }

    public function test_email_and_supported_cv_are_required(): void
    {
        Storage::fake('local');
        Mail::fake();

        $response = $this->post(route('careers.store'), [
            'full_name' => 'متقدم جديد',
            'phone' => '0999999999',
            'cv' => UploadedFile::fake()->create('resume.exe', 10, 'application/octet-stream'),
        ], ['Accept' => 'application/json']);

        $response->assertUnprocessable()->assertJsonValidationErrors(['email', 'cv']);
        $this->assertDatabaseCount('job_applications', 0);
        Mail::assertNothingSent();
    }

    public function test_open_application_copy_is_available_in_english(): void
    {
        $this->withSession(['locale' => 'en'])
            ->get(route('careers'))
            ->assertOk()
            ->assertSeeText('Applications Are Always Open')
            ->assertDontSeeText('باب التقديم مفتوح دائمًا');
    }

    public function test_cv_download_requires_admin_authentication(): void
    {
        Storage::fake('local');
        $application = JobApplication::create([
            'full_name' => 'متقدم جديد',
            'phone' => '0999999999',
            'email' => 'applicant@example.com',
            'department' => 'تقديم مفتوح',
            'preferred_branch' => 'غير محدد',
            'cv_path' => 'job-applications/resume.pdf',
        ]);
        Storage::disk('local')->put($application->cv_path, '%PDF-1.4 test');

        $this->get(route('admin.applications.cv', $application))
            ->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.applications.cv', $application))
            ->assertOk()
            ->assertDownload('CV-'.$application->id.'.pdf');
    }
}
