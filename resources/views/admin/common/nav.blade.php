<audio id="mysound" src="{{asset('sound/not-bad.mp3')}}"></audio>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>


  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if(notificationCount() > 0)
        <span class="badge badge-danger navbar-badge"><span class="notificationCount">{{notificationCount()}}</span></span>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header"><span class="notificationCount">{{notificationCount()}}</span> Notifications</span>
        <div class="dropdown-divider"></div>
        @if(auth()->guard('admin')->user()->type == 1)
        <a href="{{route('orders')}}" class="dropdown-item">
          <i class="fas fa-shopping-cart mr-2"></i> <span class="orderCount">{{orderCount()}}</span> new orders
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('appointments')}}" class="dropdown-item">
          <i class="fas fa-calendar-check mr-2"></i> <span class="appointmentCount">{{appointmentCount()}}</span> new appointments
        </a>
        @else
        <a href="{{route('doctorAppointments')}}" class="dropdown-item">
          <i class="fas fa-calendar-check mr-2"></i> <span class="appointmentCount">{{appointmentCount()}}</span> new appointments
        </a>
        @endif
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-address-card"></i>
      </a>
      <div class="dropdown-menu dropdown-menu dropdown-menu-right">
        <!-- <a href="#" class="dropdown-item">
          <i class="fas fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div> -->
        <a href="{{route('admin.logout')}}" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->