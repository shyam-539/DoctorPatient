@extends('layouts.admin-dashboard')
@section('content')

<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$newRequestCount}}</h3>

              <p>New Requests</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('admin.request.bookings')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$appoinmentCount}}</h3>

                <p>Appoinments</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
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
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('admin.doctor.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</section><br>

<div class="row">
    <div class="section col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Bookings
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  {{-- <li class="nav-item">
                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                  </li> --}}
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                  </li> --}}
                </ul>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                     style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                 </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
        </div>
    </div>
</div>

@endsection
