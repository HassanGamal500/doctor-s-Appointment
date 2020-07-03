@extends('admin.common.index')
@section('page_title')
  Orders
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List Of Orders</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Orders</li>
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
                <th>Patient Info</th>
                <th>Pain Info</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>
                    <strong>Username</strong>: {{$order->patientInfo->username}}<br>
                    <strong>Phone</strong>: {{$order->patientInfo->phone}}<br>
                    <strong>Email</strong>: {{$order->patientInfo->email}}<br>
                    <strong>Gender</strong>: {{$order->patientInfo->gender}}<br>
                  </td>
                  <td>
                    <strong>Pain Name</strong>: {{$order->PainInfo->pain_name}}<br>
                    <strong>History</strong>: {{$order->created_at}}<br>
                    @if($order->comment != null)<strong>Comment</strong>: {{$order->comment}}@endif
                  </td>
                  <td>
                    @if($order->status_id == 1)
                    <a type="button" class="btn btn-block btn-success" href="{{route('add_appointment_order', $order->order_id)}}">Make Appointment
                    </a>
                    @else
                    <button type="button" class="btn btn-block btn-secondary disabled">Done</button>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Patient Info</th>
                <th>Pain Info</th>
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