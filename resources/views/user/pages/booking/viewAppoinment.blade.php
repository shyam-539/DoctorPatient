@extends('layouts.user-view-index')
@section('content')


<h3><u>Appoinments</u></h3>
@if ($booking->isEmpty())
<br><div class="card p-3"><p>Requests are not confirmed yet.</p></div>
@else
<p >Here is your Appoinments. If there is any prescription, view in Action.
<table class="table text-center">
   <thead>
       <tr>
           <th>Patient Name</th>
           <th>Doctor Name</th>
           <th>Specialization</th>
           <th>Date</th>
           <th>Time</th>
           <th class="text-center">Action</th>
           {{-- <th>Prescreption</th> --}}

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

           <td><a href="{{route('user.booking.patient_details',$bookings->bookingId)}}"><i class='fas fa-eye'></i></a></td>

           {{-- @if ($bookings->selected_date == now()->format('Y-m-d'))
               <td><a href="{{ route('user.booking.prescription', $bookings->bookingId) }}"><i class='fas fa-notes-medical'></i></a></td>
           @endif --}}

       </tr>

       @endforeach

   </tbody>
</table>
@endif
@endsection
