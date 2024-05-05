@extends('layouts.admin-view-index')
@section('content')
@if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
<h2><u>Confirmed Appointments</u></h2><br>
@if ($booking->isEmpty())
<p>No Appointments confirmed.</p>
@else
<table class="table text-center">
    <thead>
        <tr>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Date</th>
            <th>Time</th>
            <th>Action</th>
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
            <td><a href="{{route('admin.request.approved_patient_details',['bookingRequest'=>$bookings->bookingId])}}"><i class='fas fa-eye'></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection
