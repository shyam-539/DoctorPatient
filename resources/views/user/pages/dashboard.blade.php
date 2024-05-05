@extends('layouts.user-dashboard')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$newRequestCount}}</h3>
                        <p>Requests</p>
                    </div>
                    <div class="icon">
                        <i class='fas fa-book-medical' style='font-size:56px'></i>
                    </div>
                    <a href="{{route('user.request.view_request')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$appoinmentCount}}</h3>
                        <p>Appointments</p>
                    </div>
                    <div class="icon">
                        <i class='fas fa-user-check' style='font-size:56px'></i>
                    </div>
                    <a href="{{route('user.booking.view_appoinment')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$consultationCount}}</h3>
                        <p>Consultations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('user.booking.consultation')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$cancelCount}}</h3>
                        <p>Cancelled Requests</p>
                    </div>
                    <div class="icon">
                        <i class='fas fa-user-times' style='font-size:56px'></i>
                    </div>
                    <a href="{{route('user.request.cancel')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="section col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    Bookings
                </h3>
            </div>
            <div class="card-body">
                <canvas id="bookingChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-primary text-light">
            <div class="inner">
                <h3>{{$specializationCount}}</h3>
                <p style="font-size: 18px">Specializations</p>
                <div class="icon">
                    <i class="fa fa-stethoscope" style="font-size:56px;"></i>

                </div>
            </div>
            {{-- <div class="Specializations text-light">
                @foreach ($Specialization as $row)
                    <div>
                        <a href="{{route('user.doctor.index',$row->id)}}" class="p-3 text-light"><i class='fas fa-calendar-check'></i>&nbsp;&nbsp;{{ $row->specialization }}</a>
                    </div>
                @endforeach
            </div> --}}
            <a href="{{route('user.doctor.specialization.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>
</section><br>




@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('bookingChart').getContext('2d');
    var bookingChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Requests', 'Appointments', 'Cancellations', 'Consultations'],
            datasets: [{
                label: 'Counts',
                data: [{!! $newRequestCount !!}, {!! $appoinmentCount !!}, {!! $cancelCount !!}, {!! $consultationCount !!}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>


@endpush
@endsection
