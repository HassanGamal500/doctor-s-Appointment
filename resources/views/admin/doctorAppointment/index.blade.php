@extends('admin.common.index')
@section('page_title')
  Doctor's Appointments
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List Of Doctor's Appointments</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Doctor's Appointments</li>
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
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover datatable">
              <thead>
              <tr>
                <th>ID</th>
                <th>Patient's Username</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                @foreach($appointments as $appointment)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$appointment->patientInfo->username}}</td>
                  <td>{{$appointment->appointment_date}}</td>
                  <td>{{$appointment->appointment_time}}</td>
                  <td id="{{ $appointment->appointment_id }}">
                    @if($appointment->status_id == 1)
                    <button type="button" class="btn btn-success alertStatusDoctor" data-id="{{ $appointment->appointment_id }}" data-status="2">Accepted</button>
                    <button type="button" class="btn btn-danger alertStatusDoctor" data-id="{{ $appointment->appointment_id }}" data-status="3">Rejected</button>
                    @elseif($appointment->status_id == 2)
                    <button type="button" class="btn btn-success disabled">Accept</button>
                    @else
                    <button type="button" class="btn btn-danger disabled">Rejected</button>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Patient's Username</th>
                <th>Date</th>
                <th>Time</th>
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