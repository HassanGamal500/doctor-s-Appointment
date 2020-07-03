@extends('admin.common.index')
@section('page_title')
  Add Appointment
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Add New Appointment</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	          		<li class="breadcrumb-item"><a href="{{route('appointments')}}">Appointments</a></li>
	          		<li class="breadcrumb-item active">Add New Appointment</li>
	        	</ol>
	      	</div>
	    </div>
  	</div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  	<div class="container-fluid">
  		@if(session()->has('error'))
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-ban"></i> ERROR!</h5>
			{{session()->get('error')}}
		</div>
		@elseif(session()->has('message'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> SUCCESS!</h5>
			{{session()->get('message')}}
		</div>
		@endif
	    <div class="row">
	      	<!-- left column -->
	      	<div class="col-md-12">
		        <!-- jquery validation -->
		        <div class="card card-primary">
		          	<!-- /.card-header -->
		          	<!-- form start -->
		          	<form role="form" id="quickForm" method="post" action="{{route('store_appointment')}}">
		          		@CSRF
			            <div class="card-body">
			              	<div class="form-group">
				                <label for="exampleInputAppointmentDate">Appointment Date</label>
				                <input type="date" name="appointment_date" class="form-control" id="exampleInputAppointmentDate" value="{{ old('appointment_date') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputAppointmentTime">Appointment Time</label>
				                <input type="time" name="appointment_time" class="form-control" id="exampleInputAppointmentTime" value="{{ old('appointment_time') }}">
			              	</div>

			              	@if($patients->count() > 1)
			              	<div class="form-group">
				                <label for="exampleInputPatientName">Patient Name</label>
				                <select name="patient" class="form-control select2" id="exampleInputPatientName" style="width: 100%;">
				                	<option selected disabled>Choose...</option>
				                	@foreach($patients as $patient)
				                		<option value="{{ $patient->id }}">{{ $patient->username }}</option>
				                	@endforeach
				                </select>
			              	</div>
			              	@else
			              	<div class="form-group">
				                <label for="exampleInputPatientName">Patient Name</label>
				                <select name="patient" class="form-control" id="exampleInputPatientName">
				                	@foreach($patients as $patient)
				                		<option selected value="{{ $patient->id }}">{{ $patient->username }}</option>
				                	@endforeach
				                </select>
				                <input type="hidden" name="order_done" value="{{$order->order_id}}">
			              	</div>
			              	@endif

			              	<div class="form-group">
				                <label for="exampleInputDoctorName">Doctor Name</label>
				                <select name="doctor" class="form-control select2" id="exampleInputDoctorName" style="width: 100%;">
				                	<option selected disabled>Choose...</option>
				                	@foreach($doctors as $doctor)
				                		<option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
				                	@endforeach
				                </select>
			              	</div>

		            	</div>
			            <!-- /.card-body -->
			            <div class="card-footer">
			              	<button type="submit" class="btn btn-primary">Submit</button>
			            </div>
		          	</form>
		        </div>
		        <!-- /.card -->
	        </div>
	      	<!--/.col (left) -->
	      	<!-- right column -->
	      	<div class="col-md-6">

	      	</div>
	      <!--/.col (right) -->
	    </div>
	    <!-- /.row -->
  	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection