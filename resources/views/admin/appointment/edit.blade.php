@extends('admin.common.index')
@section('page_title')
  Edit Appointment
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Edit Appointment</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	          		<li class="breadcrumb-item"><a href="{{route('appointments')}}">Appointments</a></li>
	          		<li class="breadcrumb-item active">Edit Appointment</li>
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
		          	<form role="form" id="quickForm" method="post" action="{{route('update_appointment', $appointment->appointment_id)}}">
		          		@CSRF
			            <div class="card-body">
			              	<div class="form-group">
				                <label for="exampleInputAppointmentDate">Appointment Date</label>
				                <input type="date" name="appointment_date" class="form-control" id="exampleInputAppointmentDate" value="{{ $appointment->appointment_date }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputAppointmentTime">Appointment Time</label>
				                <input type="time" name="appointment_time" class="form-control" id="exampleInputAppointmentTime" value="{{ $appointment->appointment_time }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputPatientName">Patient Name</label>
				                <select name="patient" class="form-control select2" id="exampleInputPatientName" style="width: 100%;">
				                	<option selected disabled>Choose...</option>
				                	@foreach($patients as $patient)
				                		<option value="{{ $patient->id }}" {{$appointment->patient_id == $patient->id ? 'selected' : ''}}>{{ $patient->username }}</option>
				                	@endforeach
				                </select>
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputDoctorName">Doctor Name</label>
				                <select name="doctor" class="form-control select2" id="exampleInputDoctorName" style="width: 100%;">
				                	<option selected disabled>Choose...</option>
				                	@foreach($doctors as $doctor)
				                		<option value="{{ $doctor->id }}" {{$appointment->doctor_id == $doctor->id ? 'selected' : ''}}>{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
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