@extends('admin.common.index')
@section('page_title')
  Appointments
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List Of Appointments</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Appointments</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{route('add_appointment')}}" class="btn bg-gradient-success">Add New</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover datatable">
              <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                @foreach($appointments as $appointment)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$appointment->patientInfo->username}}</td>
                  <td>{{$appointment->doctorInfo->first_name}} {{$appointment->doctorInfo->last_name}}</td>
                  <td>{{$appointment->appointment_date}}</td>
                  <td>{{$appointment->appointment_time}}</td>
                  <td>
                    @if($appointment->status_id == 1)
                    <button type="button" class="btn btn-warning disabled">Pending</button>
                    @elseif($appointment->status_id == 2)
                    <button type="button" class="btn btn-success disabled">Accepted</button>
                    @else
                    <button type="button" class="btn btn-danger disabled">Rejected</button>
                    @endif
                  </td>
                  <td>
                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      Actions
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="{{route('edit_appointment', $appointment->appointment_id)}}">Edit</a>
                      <button class="dropdown-item alerts" data-url="{{asset('admin/delete_appointment')}}/" data-table="datatable" data-id="{{ $appointment->appointment_id }}">Delete</button>
                    </div>
                    
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection