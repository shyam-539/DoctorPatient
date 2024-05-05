@extends('layouts.user-index')
@section('content')
    <h2><u>Patient Details</u></h2><br>
{{-- @dd($ViewPatientDetails) --}}
    <div class="card p-3">
        <table>
            <div class="h4" style="font-size: 30px; "><u><b>{{$ViewPatientDetails->name}}</b></u></div>
            <br>
            @php
                $currentdate = date('Y-m-d');

            @endphp
            @if ($ViewPatientDetails->selected_date <= $currentdate && $ViewPatientDetails->status == 1)
            <tr>
                <th>Prescription</th>
                <th>:</th>
                <td><a href="{{route('user.booking.prescription',$ViewPatientDetails->bookingId)}}"><i class='fas fa-notes-medical'></i></a></td>
            </tr>
            @endif

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
            </tr>
            <tr>
                <th>Address</th>
                <th>:</th>
                <td>{{$ViewPatientDetails->address}}</td>
            </tr>
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

        </table>
    </div>
@endsection
