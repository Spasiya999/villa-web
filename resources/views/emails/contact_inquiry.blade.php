<x-mail::message>
    # New Contact Inquiry Received

    You have received a new inquiry from the website's contact form.

    **Details:**

    - **Name:** {{ $inquiry->name }}
    - **Email:** {{ $inquiry->email }}
    - **Phone:** {{ $inquiry->phone ?? 'Not provided' }}
    - **Message:**
    {{ $inquiry->message }}

    <x-mail::button :url="config('app.url') . '/admin/contact-inquiries/' . $inquiry->id">
        View in Admin Panel
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>