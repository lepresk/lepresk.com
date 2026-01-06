<x-mail::message>
# New Contact Form Submission

You have received a new contact form submission from your website.

## Contact Details

**Name:** {{ $name }}
**Email:** {{ $email }}
**Subject:** {{ $subject }}

## Message

{{ $messageBody }}

---

<x-mail::button :url="'mailto:' . $email">
Reply to {{ $name }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Contact Form
</x-mail::message>
