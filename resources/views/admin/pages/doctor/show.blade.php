@extends('layouts.admin-view-calender')
@section('content')
@if(Session::has('success'))
    <p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
@if(Session::has('error'))
    <p class="alert alert-warning">{{ Session::get('success') }}</p>
@endif

<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet' />

<h2 ><u>Doctor Profile</u></h2>
<p >
    Click on <span style="color: rgb(40, 124, 202)">Avalible</span> to add Time Slot for the Doctor and click on the date to view the time slot of that day.</p><br>
<div class="d-flex" style="column-gap: 30px">
    <div class="col-md-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if($doctor->images)
                    @foreach($doctor->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/image/'.$image->image) }}" class="rounded-circle d-block w-100" alt="photo" style="width: 100%; height: 200px;">
                        </div>
                    @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only ">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><br>
        <div class="h4 text-center">{{ $doctor->name }}</div>
        <div class="text-center">{{ $doctor->email }}</div>
        <div class="text-center">{{ $doctor->phone }}</div><br>


        <div class="text-center"><u><b>Qualifications:</b></u></div>
        @foreach($doctorQualifications as $qualification)
            <div class="text-center">{{ $qualification }}</div>
        @endforeach <br>


        <div class="text-center"><u><b>Specialization:</b></u></div>
        @if($doctor->specializations)
            @foreach($doctor->specializations as $specialization)
                <div class="text-center">{{ $specialization->specialization }}</div>
            @endforeach
        @endif<br>

        <div class="d-flex text-center" style="column-gap: 20px">
            <button type="submit" class="btn btn-success" style="margin-left: 50px">
                <a href="{{route('admin.doctor.edit',$doctor->id)}}" class="text-light" ><i class='fas fa-edit' style="font-size: 18px;" >Edit</i></a>
            </button>

            <form action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this doctor?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash" style="font-size: 18px;"></i> <b>Delete</b>
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-9">
        <div id="calendar"></div>
    </div>

</div>

@push('scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>

<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next ',
                center: 'title',
                right: 'month'
            },
            defaultView: 'month',
            editable: false,
            height: 600,
            aspectRatio: 1.5,
            events: {!! $SlotEvents !!},
            eventClick: function(calEvent, jsEvent, view) {
                var selectedDate = calEvent.start.format('YYYY-MM-DD');
                window.location.href = '{{ route('admin.slot.createTime', ['doctor' => $doctor->id]) }}' + '?selected_date=' + selectedDate;
            },
            dayClick: function(date, jsEvent, view) {
                window.location.href = '{{ route('admin.slot.viewTime', ['doctor' => $doctor->id]) }}' + '?date=' + date.format();
            },

        });
    });
</script>

@endpush
@endsection
