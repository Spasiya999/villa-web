<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Mail\ContactInquiryMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        $inquiry = ContactInquiry::create($validated);

        // Fetch admin emails from settings
        $adminEmailsSetting = \App\Models\Setting::get('admin_emails');
        
        // Split by comma, trim whitespace, and filter empty values
        if ($adminEmailsSetting) {
            $adminEmails = array_filter(array_map('trim', explode(',', $adminEmailsSetting)));
        } else {
            // Fallback to contact_email or config mail
            $adminEmails = [\App\Models\Setting::get('contact_email', config('mail.from.address'))];
        }
        
        try {
            if (!empty($adminEmails)) {
                Mail::to($adminEmails)->send(new ContactInquiryMail($inquiry));
            }
        } catch (\Exception $e) {
            // Log error but don't stop the user
            \Log::error('Failed to send contact inquiry email: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }
}
