@extends('layouts.admin-view-index')
@section('content')
    <h2><u>Patient Details</u></h2>
    <div class="card p-3">
        <table>
            <div class="h4" style="font-size: 30px; "><u><b>{{$ViewPatientDetails->name}}</b></u></div>

            <tr>
                <th>Doctor Name</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->doctor_name}}</td>
            </tr>
            <tr>
                <th>Specialization</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->specialization}}</td>
            </tr>
            <tr>
                <th>Date Of Consultation</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->selected_date}}</td>
            </tr>
            <tr>
                <th>Time Of Consultation</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->start_time}}-{{$ViewPatientDetails->end_time}}</td>
            </tr>
            <tr>
                <th>DOB</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->date_of_birth}}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->gender}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->phone}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->email}}</td>
            <tr>
                <th>Reference</th>
                <th>:</th>
                <td>
                    @if($ViewPatientDetails->uploads)
                        <a href="{{ asset('storage/uploads/' . $ViewPatientDetails->uploads) }}" download>Download Reference</a>
                    @else
                        No reference available
                    @endif
                </td>
            </tr>

        </table><br>
        @php
            $selectedDate = $ViewPatientDetails->selected_date;
            $currentDate = now()->format('Y-m-d');
        @endphp
        @if($selectedDate === $currentDate)
            <div>
                <button class="btn btn-primary"><a href="{{ route('admin.prescription.show', ['bookingId' => $ViewPatientDetails->bookingId]) }}" class="text-light">Add Prescription</a></button>
            </div>
        @endif
    </div>

@endsection
