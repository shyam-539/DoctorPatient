@extends('layouts.admin-index')
@section('content')
    <h2><u>Update Specialization</u></h2><br>
    <form action="{{route('admin.specialization.update',$specialization->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <input type="text" name="specialization" class="form-control" value="{{old('specialization',$specialization->specialization)}}">
            @error('specialization')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div><br>

        <div>
            <input type="submit" name="submit" class="btn btn-primary form-control" value="Update">
        </div>
    </form>
@endsection
