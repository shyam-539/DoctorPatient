@extends('layouts.admin-index')
@section('content')
<div class="card p-3">
    <h3><u>Reason for Rejecting</u></h3><br>
    <form id="rejectionForm" method="POST" action="{{route('admin.request.store_rejection',$bookingId)}}">
        @csrf
        <input type="hidden" name="booking_request_id" value="{{$bookingId}}">
        <div class="form-group">
            <label for="rejectionReason">Reason:</label>
            <textarea class="form-control" id="rejectionReason" name="reason" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
