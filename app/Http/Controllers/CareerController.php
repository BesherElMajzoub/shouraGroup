<?php

namespace App\Http\Controllers;

use App\Mail\NewJobApplication;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CareerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'preferred_branch' => ['nullable', 'string', 'max:255'],
            'cover_letter' => ['nullable', 'string', 'max:3000'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $cvPath = $request->file('cv')->store('job-applications', 'local');

        try {
            unset($validated['cv']);
            $validated['department'] = ($validated['department'] ?? null) ?: 'تقديم مفتوح';
            $validated['preferred_branch'] = ($validated['preferred_branch'] ?? null) ?: 'غير محدد';
            $validated['cv_path'] = $cvPath;

            $application = JobApplication::create($validated);
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($cvPath);
            throw $exception;
        }

        $emailSent = true;

        try {
            $recipient = setting('hr_email') ?: config('mail.from.address');

            Mail::to($recipient)
                ->send(new NewJobApplication($application));
        } catch (Throwable $exception) {
            $emailSent = false;
            Log::error('Job application email notification failed.', [
                'job_application_id' => $application->id,
                'exception' => $exception,
            ]);
        }

        return response()->json([
            'ok' => true,
            'email_sent' => $emailSent,
        ]);
    }
}
