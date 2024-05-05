 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: black" >
    <a href="{{route('user.doctor.specialization.index')}}" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>ABC Hospital</b></span>
      </a>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="#" class="nav-link ">
                  <p>
                      Bookings<i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('user.request.view_request')}}" class="nav-link ">
                          <p> Requests</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user.booking.view_appoinment')}}" class="nav-link">
                          <p>Appoinments</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{route('user.booking.consultation')}}" class="nav-link">
                          <p>Consultations</p>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item menu-open">
                <a href="{{route('user.request.cancel')}}" class="nav-link ">
                    <p>
                        Messages
                    </p>
                </a>

            </li>
        </ul>
    </nav>
  </aside>


