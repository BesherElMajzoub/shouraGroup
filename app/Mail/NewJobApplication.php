<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class NewJobApplication extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public JobApplication $application) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->application->email, $this->application->full_name)],
            subject: 'طلب توظيف جديد — '.$this->application->full_name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.job-application');
    }

    public function attachments(): array
    {
        $extension = pathinfo($this->application->cv_path, PATHINFO_EXTENSION);
        $safeName = Str::slug($this->application->full_name) ?: 'applicant';

        return [
            Attachment::fromStorageDisk('local', $this->application->cv_path)
                ->as("CV-{$safeName}.{$extension}"),
        ];
    }
}
