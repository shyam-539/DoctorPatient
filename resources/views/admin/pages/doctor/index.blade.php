@extends('layouts.admin-view-index')
@section('content')
@if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
@endif
<h2><u>Complete Doctor is Here</u></h2><p>You can add the Slots for Doctor according to their Availability and View the Doctor Profile</p><br>

<div style="margin-left: 800px"> <a href="{{route('admin.doctor.create')}}" class="btn btn-primary"><i class="fa fa-user-md"> Add Doctor</i></a></div><br>

<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="3"></th>
            <th colspan="2">Slot</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td> {{$row->name}} </td>
                <td><a href="{{route('admin.doctor.edit',$row->id)}}"><i class='fas fa-edit'></i></a></td>
                <td><a href="{{route('admin.doctor.show',$row->id)}}"><i class='fas fa-eye'></i></a></td>
                <td><a href="{{route('admin.slot.create',$row->id)}}"><i class='fas fa-plus'></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
