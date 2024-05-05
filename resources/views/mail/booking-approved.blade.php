<x-mail::message>
# Booking Approved

Your booking has been approved for {{$booking->specialization_name}} doctor {{$booking->doctor_name}}. Here are the details:

-Booking ID:{{$booking->id}}

-Consulatation Date:{{$booking->selected_date}}

--Consultation Time:{{$booking->time}}
{{--

<x-mail::button :url="''">
Button Text
</x-mail::button> --}}


Thanks,<br>
{{ $booking->name }}
</x-mail::message>
