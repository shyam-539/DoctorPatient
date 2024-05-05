@extends('layouts.user-index')
@section('content')
<h3><u>User Booking Cancelled</u></h3><br>
@if ($booking->isEmpty())
<div class="card p-3">
    <p>No Requests Cancelled yet</p>
</div>
@else

@foreach ($booking as $bookings)
    <div class="card p-3">
    Hi {{$bookings->patient_name}},<br>
         Booking For {{$bookings->specialization}} Doctor {{$bookings->doctor_name}} on {{$bookings->selected_date}}, {{$bookings->start_time}}-{{$bookings->end_time}}
        has been Cancelled due to <b>{{$bookings->reason}}.</b>
    </div>
@endforeach

@endif
@endsection
