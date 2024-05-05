@extends('layouts.admin-dashboard')
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

                <i class='fas fa-plus' style='font-size:54px'></i>
            </div>
            <a href="{{route('admin.request.bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$appoinmentCount}}</h3>

                <p>Appoinments</p>
              </div>
              <div class="icon">
                <i class='far fa-calendar-check' style='font-size:54px'></i>
              </div>
              <a href="{{route('admin.request.appoinments')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$usersCount}}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('admin.user.view-user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$doctorsCount}}</h3>

                <p>Doctors</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-md"></i>
              </div>
              <a href="{{route('admin.doctor.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</section><br>

<div class="row">
    <div class="section col-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Total Bookings
                </h3>
            </div>
            <div class="card-body">
                <canvas id="totalBookingPieChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="section col-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line mr-1"></i>
                    Yearly Bookings
                </h3>
            </div>
            <div class="card-body">
                <canvas id="yearlyBookingLineChart" width="800" height="400"></canvas>
            </div>
        </div>
    </div>


</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctxPie = document.getElementById('totalBookingPieChart').getContext('2d');
    var totalBookingPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Requests', 'Appointments'],
            datasets: [{
                label: 'Counts',
                data: [{!! $newRequestCount !!}, {!! $appoinmentCount !!}],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
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

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

{{-- <script>
  const ctx = document.getElementById('totalBookingPieChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'december'],
      datasets: [{
        label: '#Request',
        data: [{!! json_encode(array_values($monthlyRequestsCount)) !!}],
        borderWidth: 1
      },
      {
        label: '#Appoinment',
        data: [{!! json_encode(array_values($monthlyAppointmentsCount)) !!}],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script> --}}


<script>
    var ctxYearlyLine = document.getElementById('yearlyBookingLineChart').getContext('2d');
    var yearlyBookingLineChart = new Chart(ctxYearlyLine, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Requests',
                data: {!! json_encode(array_values($monthlyRequestsCount)) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Appointments',
                data: {!! json_encode(array_values($monthlyAppointmentsCount)) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>




@endpush

@endsection
