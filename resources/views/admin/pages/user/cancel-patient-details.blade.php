@extends('layouts.admin-view-index')
@section('content')
    <h2><u>Patient Details</u></h2><br>
    <div class="card p-3">
        <table>
            <div class="h4" style="font-size: 30px;"><u><b>{{$ViewPatientDetails->name}}</b></u></div>
            <br>
            <tr>
                <th>Reason for Cancel</th>
                <td>{{$ViewPatientDetails->reason}}</td>
            </tr>
            <tr>
                <th>Doctor Name</th>
                <td>{{$ViewPatientDetails->doctor_name}}</td>
            </tr>
            <tr>
                <th>Specialization</th>
                <td>{{$ViewPatientDetails->specialization}}</td>
            </tr>
            <tr>
                <th>Date Of Consultation</th>
                <td>{{$ViewPatientDetails->selected_date}}</td>
            </tr>
            <tr>
                <th>Time Of Consultation</th>
                <td>{{$ViewPatientDetails->start_time}}-{{$ViewPatientDetails->end_time}}</td>
            </tr>
            <tr>
                <th>DOB</th>
                <td>{{$ViewPatientDetails->date_of_birth}}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{$ViewPatientDetails->gender}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{$ViewPatientDetails->phone}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$ViewPatientDetails ->email}}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{$ViewPatientDetails->address}}</td>
            </tr>

            <tr>
                <th>Reference</th>
                <td>
                    @if($ViewPatientDetails->uploads)
                        <a href="{{ asset('storage/uploads/' . $ViewPatientDetails->uploads) }}" download>Download Reference</a>
                    @else
                        No reference available
                    @endif
                </td>
            </tr>


        </table><br>

    </div>

@endsection


