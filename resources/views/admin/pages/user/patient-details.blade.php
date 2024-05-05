@extends('layouts.admin-view-index')
@section('content')
    <h2><u>Patient Details</u></h2><br>

    <div class="card p-3">
        <table>
            <div class="h4" style="font-size: 30px;"><u><b>{{$ViewPatientDetails->name}}</b></u></div>
            <br>
            <tr>
                <th>Doctor Name</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails->doctor_name}}</td>
            </tr>
            <tr>
                <th>Specialization</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails->specialization}}</td>
            </tr>
            <tr>
                <th>Date Of Consultation</th>
                {{-- <th>:</t/h> --}}
                <td>{{$ViewPatientDetails->selected_date}}</td>
            </tr>
            <tr>
                <th>Time Of Consultation</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails->start_time}}-{{$ViewPatientDetails->end_time}}</td>
            </tr>
            <tr>
                <th>DOB</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails->date_of_birth}}</td>
            </tr>
            <tr>
                <th>Gender</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails->gender}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails->phone}}</td>
            </tr>
            <tr>
                <th>Email</th>
                {{-- <th>:</th> --}}
                <td>{{$ViewPatientDetails ->email}}</td>
            </tr>
            <tr>
                <th>Address</th>
                {{-- <th>:</th> --}}
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
        <div >

            <button class="btn btn-light approve-btn" style="margin-left: 160px"  name="approve"><a href="{{route('admin.request.approve',$ViewPatientDetails->bookingId)}}"><i class="fa fa-check" style="font-size:52px;color:green"></i></a></button>
            <button class="btn btn-light reject-btn" style="margin-left: 60px"  name="reject" ><a href="{{route('admin.request.rejection',$ViewPatientDetails->bookingId)}}"><i class="fa fa-times" style="font-size:52px;color:red"></i></a></button>

        </div>
    </div>

@endsection


