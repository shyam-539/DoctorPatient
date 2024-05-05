@extends('layouts.admin-view-index')
@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<h2><u>Time for {{$doctor->name}}</u></h2>
<p>You can add, view and delete time slots for the doctor.</p>
<div class="container">
    <div class="d-flex" style="column-gap: 70px">
        <div class="col-6">
            <form action="{{ route('admin.slot.StoreTime', ['doctor' => $doctor->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $selectedDate }}" required>
                </div>
                <div class="form-group">
                    <label for="timeRanges">Time:</label>
                    <div id="timeRangesContainer">
                        @foreach($timeSlots as $timeSlot)
                            <div class="time-range d-flex align-items-center">
                                <input type="time" class="form-control mr-2" name="start_times[]" value="{{$timeSlot->start_time}}" required>
                                -
                                <input type="time" class="form-control ml-2" name="end_times[]" value="{{$timeSlot->end_time}}" required>
                                &nbsp;
                                <a href="javascript:void(0)" class="delete text-danger" data-id="{{$timeSlot->id}}"><i class="fas fa-trash" style="font-size: 18px;"></i></a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div>
                        <button type="button" class="btn btn-success add-time-range"><i class='fas fa-clock'></i> Add Time Range</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash">
                                <a href="{{ route('admin.slot.destroy', ['doctor' => $doctor->id, 'selected_date' => $selectedDate]) }}" class="text-light"> Delete Date</a>
                            </i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.add-time-range').on('click', function () {
            var timeRangeInput = '<div class="time-range d-flex align-items-center">' +
                '<input type="time" class="form-control mr-2" name="start_times[]" required>' +
                '-' +
                '<input type="time" class="form-control ml-2" name="end_times[]" required>' +
                '&nbsp;' +
                '<a href="javascript:void(0)" class="delete text-danger"><i class="fas fa-trash" style="font-size: 18px;"></i></a>' +
                '</div>';
            $('#timeRangesContainer').append(timeRangeInput);
        });

        $(document).on('click', '.delete', function () {
            var $self = $(this);
            var id = $self.data('id');
            if (confirm("Are you sure you want to delete this TimeSlot?")) {
                $.ajax({
                    url: '/admin/slot/TimeDestroy/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $self.closest('.time-range').remove();
                    },
                    error: function (xhr, status, error) {
                        // console.error(xhr.responseText);
                        // Display an alert message indicating the failure
                        alert('Failed to delete Slot. Please try again.');
                    }
                });
            }
        });
    });
</script>
@endpush

@endsection
