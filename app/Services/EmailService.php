<?php

namespace App\Services;

use App\Models\ContactSubmission;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendContactNotification(ContactSubmission $submission): void
    {
        $adminEmail = config('mail.admin_email', config('mail.from.address'));
        
        Mail::send('emails.contact-notification', [
            'submission' => $submission,
        ], function ($message) use ($adminEmail, $submission) {
            $message->to($adminEmail)
                ->subject('New Contact Form Submission: ' . ($submission->subject ?: 'No Subject'));
        });
    }

    public function sendContactConfirmation(ContactSubmission $submission): void
    {
        Mail::send('emails.contact-confirmation', [
            'submission' => $submission,
        ], function ($message) use ($submission) {
            $message->to($submission->email)
                ->subject('Thank you for contacting us');
        });
    }
}

