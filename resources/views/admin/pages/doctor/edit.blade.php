@extends('layouts.admin-index')
@section('content')
<h2><u>Doctor Updation</u></h2><br>
<form action="{{ route('admin.doctor.update',$doctor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your Name" value="{{ old('name', $doctor->name) }}">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your Email" value="{{ old('email', $doctor->email) }}">
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter your Phone Number" value="{{ old('phone', $doctor->phone) }}">
        @error('phone')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <hr>

    <div>
        <label for="qualification">Medical Qualification:</label><br>
        <div class="d-flex" style="column-gap: 10px">
            @foreach ($qualifications as $value => $label)
                <input type="checkbox" name="qualification[]" id="{{ $value }}" value="{{ $value }}" {{ in_array($value, $doctor->qualifications->pluck('qualification')->toArray()) ? 'checked' : '' }}>
                <label for="{{ $value }}">{{ $label }}</label><br>
            @endforeach
        </div>
        @error('qualification')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div><br>




    <hr>

    <div>
        <label for="specializations">Specializations:</label><br>
        @foreach ($specializations as $row)
            <input type="checkbox" name="specializations[]" id="{{ $row->id }}" value="{{ $row->id }}"
                   {{ $doctor->specializations->contains('id', $row->id) ? 'checked' : '' }}>
            <label for="{{ $row->id }}">{{ $row->specialization }}</label><br>
        @endforeach
        @error('specializations')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div><br>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image[]" class="form-control" value="{{old('image',$images)}}" multiple />
        @error('image')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div><br>

    <div class="text-center">
        <input type="submit" name="submit" class="btn btn-primary form-control" >
    </div>
</form>
 @endsection
