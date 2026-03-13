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

        // Send email to admin
        // Assuming admin email is in config or just use a placeholder for now
        $adminEmail = config('mail.from.address'); 
        
        try {
            Mail::to($adminEmail)->send(new ContactInquiryMail($inquiry));
        } catch (\Exception $e) {
            // Log error but don't stop the user
            \Log::error('Failed to send contact inquiry email: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }
}
