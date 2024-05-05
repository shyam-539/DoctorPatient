@extends('layouts.admin-index')
@section('content')

<h2><u>Create Specialization</u></h2><br>

@if(Session::has('error'))
    <p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif

<form action="{{ route('admin.specialization.store')}}" method="POST">
    @csrf
    <div>
        <input type="text" name="specialization" class="form-control" placeholder="Enter new specialization Here" >
        @error('specialization')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div><br>

    <div>
        <input type="submit" name="submit" class="btn btn-primary form-control" value="Add">
    </div>
</form>
@endsection
