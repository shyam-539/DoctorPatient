@extends('layouts.admin-view-index')
@section('content')
@if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
<h2><u>Booking Requests</u></h2><br>
@if ($booking->isEmpty())
<div class="card p-3">
    No Requests
</div>
@else
        <table class="table text-center">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Specialization</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking as $bookings)
                    <tr>
                        <td>{{ $bookings->patientName }}</td>
                        <td>{{ $bookings->specialization }}</td>
                        <td>{{ $bookings->doctorName }}</td>
                        <td>{{ $bookings->selected_date }}</td>
                        <td>{{ $bookings->start_time }} - {{ $bookings->end_time }}</td>
                        <td>
                            @if ($bookings->status == 0)
                                Pending
                            @elseif ($bookings->status == 2)
                                <span style="color: red;">Cancelled</span>
                            @endif
                        </td>
                        <td>
                           @if ($bookings->status == 0)
                           <a href="{{ route('admin.request.patient_details', ['bookingRequest' => $bookings->bookingId]) }}"><i class='fas fa-eye'></i></a></td>

                           @elseif ($bookings->status == 2)
                           <a href="{{ route('admin.request.cancel_patient_details', ['bookingRequest' => $bookings->bookingId]) }}"><i class='fas fa-eye'></i></a></td>

                           @endif

                    </tr>
                @endforeach
            </tbody>
        </table>


@endif

@endsection
