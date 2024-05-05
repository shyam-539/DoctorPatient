@extends('layouts.user-index')
@section('content')

<h3><u>Prescription</u></h3>
@if ($details)
    <div class="card">
        <form class="p-3">

            <input type="hidden" name="user_id" value="{{ $details->userId }}">
            <input type="hidden" name="booking_id" value="{{ $details->bookingId }}">

            <div class="d-flex" style="column-gap: 150px">
                <input type="hidden" name="doctor_id" value="{{ $details->doctorId }}">
                <label for="">Doctor: <span style="font-size: 18px">{{ $details->doctor_name }}</span></label>

                <input type="hidden" name="specialization_id" value="{{ $details->specializationId }}">
                <label for="">Specialization: <span style="font-size: 18px">{{ $details->specialization }}</span></label>
            </div>

            <div class="d-flex" style="column-gap: 140px">
                <label for="">Date: <span style="font-size: 16px">{{ $details->selected_date }}</span></label>
                <label for="" >Time: <span style="font-size: 18px" >{{ $details->start_time }}-{{ $details->end_time }}</span></label>
            </div>
            <hr>
            <input type="hidden" name="patient_id" value="{{ $details->patientId }}">
            <label for="">Patient Name: <span style="font-size: 18px">{{ $details->name }}</span></label>

            <hr>

            <label for="">Medicinal Prescription</label><br>
            <span style="margin-left: 30px">{{ $details->medicinal_prescription }}</span>

            <hr>

            <label for="">Medical Advices</label><br>
            <span style="margin-left: 30px">{{ $details->medical_advices }}</span>

        </form>
    </div>
@else
<br><div class="card p-3"><p style="font-size: 20px">No prescriptions available.</p></div>
@endif
@endsection
