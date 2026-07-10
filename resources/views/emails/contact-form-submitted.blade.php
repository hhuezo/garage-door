<x-mail::message>
# New contact form message

**Name:** {{ $customerName }}

**Email:** {{ $email }}

@if ($phone)
**Phone:** {{ $phone }}
@endif

@if ($messageSubject)
**Subject:** {{ $messageSubject }}
@endif

**Message:**

{{ $message }}

</x-mail::message>
