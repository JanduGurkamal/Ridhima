<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    protected EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $submission = ContactSubmission::create($request->only([
            'name',
            'email',
            'subject',
            'message',
        ]));

        // Send notifications
        try {
            $this->emailService->sendContactNotification($submission);
            $this->emailService->sendContactConfirmation($submission);
        } catch (\Exception $e) {
            // Log error but don't fail the submission
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
