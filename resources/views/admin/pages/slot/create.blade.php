@extends('layouts.admin-index')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<h2><u>Add Available dates of Doctor</u></h2><br>
<form action="{{ route('admin.slot.store', $doctor->id) }}" method="POST">
    @csrf
    <div>
        <label for="dr">Doctor Name</label>
        <input type="text" name="name" class="form-control" value="{{ $doctor->name }}">
    </div><br>

    <div>
        <label for="date">Available Dates</label>
        <input type="text" id="datePicker" placeholder="Select Dates" name="dates" class="form-control" value="{{old('dates')}}"/>
        @error('dates')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div><br>

    <div>
        <input type="submit" name="submit" class="btn btn-primary">
    </div>
</form>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#datePicker", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    @foreach ($slot as $slots)
                        "{{ $slots->dates }}",
                    @endforeach
                ],
            });
        });
    </script>
@endpush
@endsection
