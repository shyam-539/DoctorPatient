@extends('layouts.admin-view-index')
@section('content')
<h2><u>All the Registered Users are here</u></h2><br>

<table class="table text-center">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Registeration</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $users)
        <tr>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            <td>{{$users->phone}}</td>
            <td>{{$users->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
