<x-mail::message>
# New appointment request

**Date:** {{ $booking->appointment_date->format('F j, Y') }}

**Time:** {{ $booking->timeSlot?->label_en ?? '—' }}

**Name:** {{ $booking->customer_name }}

**Email:** {{ $booking->customer_email }}

@if ($booking->customer_phone)
**Phone:** {{ $booking->customer_phone }}
@endif

@if ($booking->notes)
**Notes:**

{{ $booking->notes }}
@endif

</x-mail::message>
