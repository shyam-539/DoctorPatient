@extends('layouts.user-view-index')
@section('content')
@if(Session::has('success'))
        <p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
<h3><u>Booking Requests</u></h3>
@if ($booking->isEmpty())
<br>
<div class="card p-3">
    <p>No booking Request.</p>
</div>
@else
<p >Here is your Booking Requests. If your Requests approved you can view it in the <b>Appoinments</b>.
    You can see the pending and cancelled requestes here.</p><br>
<table class="table text-center">
   <thead>
       <tr>
           <th>Patient Name</th>
           <th>Doctor Name</th>
           <th>Specialization</th>
           <th>Date</th>
           <th>Time</th>
           <th>Status</th>
           <th class="text-center">Action</th>
       </tr>
   </thead>
   <tbody>
       @foreach ($booking as $bookings)
       <tr>
           <td>{{$bookings->patientName}}</td>
           <td>{{$bookings->doctorName}}</td>
           <td>{{$bookings->specialization}}</td>
           <td>{{$bookings->selected_date}}</td>
           <td>{{$bookings->start_time}}-{{$bookings->end_time}}</td>
           <td>
            @if ($bookings->status == 0)
                Pending
            @elseif ($bookings->status == 2)
            <span style="color: red;">Cancelled</span>
            @endif
        </td>
        @if ($bookings->status == 0)
            <td><a href="{{route('user.booking.patient_details',$bookings->bookingId)}}"><i class='fas fa-eye'></i></a></td>
        @elseif ($bookings->status == 2)
            <td><a href="{{route('user.booking.cancel_patient_details',$bookings->bookingId)}}"><i class='fas fa-eye'></i></a></td>
        @endif
    </tr>

       @endforeach

   </tbody>
</table>
@endif
@endsection
