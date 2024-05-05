@extends('layouts.user-view-index')
@section('content')

<h3><u>Consultations</u></h3>
@if ($booking->isEmpty())
<br>
<div class="card p-3">
<p>No Consultation Data Found.</p>
</div>
@else
<p >Here is all your Consulations.
    On clicking on  <span style="color: rgb(16, 86, 190)"><i class='fas fa-eye'></i></span>  this icon you can view the details of the patient and by clicking on the
    <span style="color: rgb(16, 86, 190)"><i class="far fa-bookmark"></i></span> you can view the Prescription by the Doctor.
</p><br>
<table class="table text-center">
   <thead>
       <tr>
           <th>Patient Name</th>
           <th>Doctor Name</th>
           <th>Specialization</th>
           <th>Date</th>
           <th>Time</th>
           <th>Prescreption</th>
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
           <td><a href="{{ route('user.booking.prescription', $bookings->bookingId) }}"><i class='fas fa-notes-medical'></i>           </a></td>
           <td><a href="{{route('user.booking.patient_details',$bookings->bookingId)}}"><i class='fas fa-eye'></i></a></td>
       </tr>

       @endforeach

   </tbody>
</table>
@endif
@endsection
