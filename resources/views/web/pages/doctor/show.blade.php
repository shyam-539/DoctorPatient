@extends('layouts.public-layout')
@section('content')
<h3><u>Available Dates of <b> {{$doctor->name}}</b></u></h3>
<p >Dates in Blue Color <span style="color: rgb(46, 121, 192)"><b>Available</b></span> are the available dates of Doctor. Click on it to book you Appoinment.</p>

<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />

<div id="calendar"></div>

@push('scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next ',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultView: 'month',
            editable: false,
            height: 600,
            aspectRatio: 1.5,
            events: {!! $slotEvents !!},
            eventClick: function(calEvent, jsEvent, view) {
                var specializationId = {{$_GET['specialization']}};
                var selectedDate = calEvent.start.format('YYYY-MM-DD');
                window.location.href = '{{ route('user.doctor.bookings', ['doctor' => $doctor->id]) }}' + '?specialization_id=' + specializationId + '&selected_date=' + selectedDate;
            }
        });
    });
</script>
@endpush
@endsection




