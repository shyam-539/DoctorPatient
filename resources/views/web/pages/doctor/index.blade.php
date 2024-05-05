@extends('layouts.public-layout')
@section('content')
<h3><u>Doctors for {{$specializations}}</u></h3>
@if ($results->isEmpty())
    <p  >No Doctors available.</p>
@else
<p>You can click on <b style="color: green"> Check Availability </b> button to know about Doctor Available dates.</p><br>
<div class="d-flex flex-wrap">
    @foreach ($results as $doctor)
        <div class="col-4 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div id="carouselExampleIndicators{{ $doctor->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @if($doctor->images)
                                @foreach($doctor->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/image/'.$image) }}" class="rounded-circle d-block w-100" alt="photo" style="width: 100%; height: 200px;">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators{{ $doctor->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators{{ $doctor->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div style="font-size: 20px;"><b>{{ $doctor->name }}</b></div>
                    <div class="card-text">{{ $doctor->email }}</div>
                    <div class="card-text">{{ $doctor->phone }}</div><br>
                    <div class="text-center">
                        <a href="{{ route('doctor.show', ['doctor' => $doctor->id, 'specialization' => $doctor->specialization_id]) }}" class="btn btn-success">Check Availability</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
@endsection
