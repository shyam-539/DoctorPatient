@extends('layouts.admin-index')
@section('content')
<h2><u>Create Doctor Here</u></h2><br>
<form action="{{ route('admin.doctor.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Doctor Name" value="{{ old('name') }}">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Doctor Email" value="{{ old('email') }}">
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter Doctor Phone Number" value="{{ old('phone') }}">
        @error('phone')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <hr>

    <div>
        <label for="qualification" style="font-size: 20px">Medical Qualification:</label><br>
        <div class="d-flex" style="column-gap: 12px">
            @foreach ($qualifications as $value => $label)
                <div class="d-flex">
                    <input type="checkbox" name="qualification[]" id="{{ $label }}" value="{{ $value }}" {{ in_array($value, old('qualification', [])) ? 'checked' : '' }}>
                    <label for="{{ $label }}">{{ $label }}</label><br>
                </div>
            @endforeach
        </div>
        @error('qualification')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>


    <hr>

    <div>
        <label for="specializations" style="font-size: 20px">Specializations:</label><br>
        <div class="d-flex" style="column-gap: 10px">
            @foreach ($specialization as $row)
            <input type="checkbox" name="specializations[]" id="{{$row->id}}" value="{{$row->id}}"
                   {{ in_array($row->id, old('specializations', [])) ? 'checked' : '' }}>
            <label for="{{$row->id}}">{{$row->specialization}}</label><br>
        @endforeach</div>
        @error('specializations')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <hr>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image[]" class="form-control" multiple />
        @error('image')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div><br>

    <div class="text-center">
        <input type="submit" name="submit" class="btn btn-primary form-control" >
    </div>

</form>
 @endsection
