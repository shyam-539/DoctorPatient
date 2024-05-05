@extends('layouts.admin-view-index')
@section('content')

{{-- @dd($details) --}}
<form action="{{ route('admin.prescription.store', ['bookingId' => $details->bookingId]) }}" method="POST" class="p-3">
    @csrf
        <h3><u>Prescription</u></h3>
        <p>
        Doctor can add any medical prescription or advice to the patient here.
        </p>
        <input type="hidden" name="user_id" value="{{$details->userId}}">
        <input type="hidden" name="booking_id" value="{{$details->bookingId}}">
        <input type="hidden" name="doctor_id" value="{{$details->doctorId}}">
        {{-- <label for="">Doctor: <span style="font-size: 18px">{{$details->doctor_name}}</span></label> --}}
        <input type="hidden" name="specialization_id" value="{{$details->specializationId}}">
            {{-- <label for="">Specialization: <span style="font-size: 18px">{{$details->specialization}}</span></label> --}}
            {{-- <label for="">Date: <span style="font-size: 16px">{{$details->selected_date}}</span></label> --}}
            {{-- <label for="" >Time: <span style="font-size: 16px">{{$details->start_time}}-{{$details->end_time}}</span></label> --}}



        <div class="d-flex" style="column-gap: 50px">
            <label for="">Doctor: <span style="font-size: 18px">{{$details->doctor_name}}</span></label>
            <label for="">Specialization: <span style="font-size: 18px">{{$details->specialization}}</span></label>
            <label for="">Date: <span style="font-size: 18px">{{$details->selected_date}}</span></label>
            <label for="" >Time: <span style="font-size: 18px">{{$details->start_time}}-{{$details->end_time}}</span></label>

        </div>
        <hr>
        <input type="hidden" name="patient_id" value="{{$details->patientId}}">
        <label for="">Patient Name: <span style="font-size: 18px">{{$details->name}}</span></label>


        <hr>

        <label for="">Medicinal Prescription</label><br>
        <textarea name="medicinal_prescription" id="medicinal_prescription" cols="60" rows="3" >{{old('medicinal_prescription',$prescription->medicinal_prescription)}}</textarea>

        <hr>

        <label for="">Medical Advices</label><br>
        <textarea name="medical_advices" id="medical_advices" cols="60" rows="3" >{{old('medical_advices',$prescription->medical_advices)}}</textarea>
        <br><br>
         <input type="submit" class="btn btn-primary" value="submit">
    </form>
@endsection
