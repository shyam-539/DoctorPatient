@extends('layouts.user-index')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
<script src='https://www.google.com/recaptcha/api.js'></script>

<form action="{{ route('user.doctor.store_bookings',['date'=>$selectedDate]) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <h3><b><u>Doctor Details</u></b></h3>
    <input type="hidden" name="doctor_id" value="{{$doctor->id}}">
    <input type="hidden" name="specialization_id" value="{{$specialization->id}}">

    <div class="d-flex" style="column-gap: 15px">
        <div><b >DoctorName:</b>{{$doctor->name }}</div>
        <div><b >DateOfConsultation:</b>{{$selectedDate}}</div>
        <div><b >Specialization:</b>{{$specialization->specialization}}</div>
    </div>

    <hr>

    <h3><b><u>Patient Details</u></b></h3>
    <table>
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <tr>
            <th>Appoinment Time</th>
            <td>
                <select name="time" class="form-control">
                    <option value="" disabled selected>Select Your Preferred Time</option> <!-- Make this option disabled and selected by default -->
                    @foreach ($timeSlots as $time)
                        <option value="{{ $time->start_time . '-' . $time->end_time }}">{{ $time->start_time }} - {{ $time->end_time }}</option>
                    @endforeach
                </select>
                @error('time')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr>
            <th>Patient Name</th>
            <td>
                <input type="text" name="name" class="form-control" placeholder="Enter Patient Name" value="{{ old('name',$user->name) }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>
                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" >
                <option value="" selected disabled>{{ __('Select Gender') }}</option>
                <option value="male" @if(old('gender') == 'male') selected @endif>{{ __('Male') }}</option>
                <option value="female" @if(old('gender') == 'female') selected @endif>{{ __('Female') }}</option>
                <option value="other" @if(old('gender') == 'other') selected @endif>{{ __('Other') }}</option>
                </select>
                @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>
                <input type="date" name="date_of_birth" class="form-control" placeholder="Enter Date Of Birth" value="{{ old('date_of_birth',$user->date_of_birth) }}">
                @error('date_of_birth')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" value="{{ old('email',$user->email) }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>
                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone',$user->phone) }}">
                @error('phone')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr>
            <th>Address</th>
            <td>
                <textarea name="address" id="address" cols="70" rows="3" class="form-control" placeholder="Enter Address">{{old('address',$user->location)}}</textarea>
                @error('address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>

        <tr>
            <th>Medical Reports</th>
            <td>
                <input type="file" name="uploads" class="form-control" placeholder="Enter Phone Number" value="{{ old('uploads') }}">
                @error('uploads')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </td>
        </tr>

        <tr>
            <th>ReCaptcha</th>
            <td>
                <div class="g-recaptcha " data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }} "></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger form-control">{{ $errors->first('g-recaptcha-response') }}</span>
                @endif
            </td>
        </tr>

    </table><br>

    <button type="submit" class="btn btn-primary form-control">Book Your Appoinment</button>
</form>
@endsection
