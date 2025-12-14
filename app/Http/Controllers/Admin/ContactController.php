<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $submissions = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.contacts.index', compact('submissions'));
    }

    public function show(ContactSubmission $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function markAsRead(ContactSubmission $contact)
    {
        $contact->markAsRead();
        return back()->with('success', 'Submission marked as read.');
    }

    public function markAsReplied(ContactSubmission $contact)
    {
        $contact->markAsReplied();
        return back()->with('success', 'Submission marked as replied.');
    }

    public function archive(ContactSubmission $contact)
    {
        $contact->archive();
        return back()->with('success', 'Submission archived.');
    }

    public function destroy(ContactSubmission $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Submission deleted successfully.');
    }
}
