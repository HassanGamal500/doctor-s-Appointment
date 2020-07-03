
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('dashboard')}}" class="brand-link">
    <img src="{{asset('assetAdmin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Appointement</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('assetAdmin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{auth()->guard('admin')->user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link {{request()->is('admin') ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @if(auth()->guard('admin')->user()->type == 1)
        <li class="nav-item">
          <a href="{{route('patients')}}" class="nav-link {{setActive('admin/patients')}}{{setActive('admin/add_patient')}}{{setActive('admin/edit_patient')}}">
            <i class="nav-icon fas fa-user-injured"></i>
            <p>
              Patients
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('doctors')}}" class="nav-link {{setActive('admin/doctors')}}{{setActive('admin/add_doctor')}}{{setActive('admin/edit_doctor')}}">
            <i class="nav-icon fas fa-user-md"></i>
            <p>
              Doctors
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('specializations')}}" class="nav-link {{setActive('admin/specialization')}}{{setActive('admin/add_specialization')}}{{setActive('admin/edit_specialization')}}">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>
              Specialization
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('pains')}}" class="nav-link {{setActive('admin/pains')}}{{setActive('admin/add_pain')}}{{setActive('admin/edit_pain')}}">
            <i class="nav-icon fas fa-briefcase-medical"></i>
            <p>
              Pains
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('orders')}}" class="nav-link {{setActive('admin/orders')}}">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Orders
              @if(checkOrder() > 0)
              <span class="right badge badge-danger">New</span>
              @endif
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('appointments')}}" class="nav-link {{setActive('admin/appointements')}}{{setActive('admin/add_appointement')}}{{setActive('admin/edit_appointement')}}">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Appointements
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{route('countries')}}" class="nav-link {{setActive('admin/countries')}}{{setActive('admin/add_country')}}{{setActive('admin/edit_country')}}">
            <i class="nav-icon fas fa-globe-africa"></i>
            <p>
              Countries
            </p>
          </a>
        </li>
        @else
        <li class="nav-item">
          <a href="{{route('doctorAppointments')}}" class="nav-link {{setActive('admin/doctorAppointments')}}">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>
              Doctor's Appointements
            </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>