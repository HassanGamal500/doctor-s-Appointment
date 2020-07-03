@extends('admin.common.index')
@section('page_title')
  Add Doctor
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Add New Doctor</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	          		<li class="breadcrumb-item"><a href="{{route('doctors')}}">Doctors</a></li>
	          		<li class="breadcrumb-item active">Add New Doctor</li>
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
		          	<form role="form" id="quickForm" method="post" action="{{route('store_doctor')}}">
		          		@CSRF
			            <div class="card-body">
			              	<div class="form-group">
				                <label for="exampleInputFirstName">First Name</label>
				                <input type="text" name="first_name" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name" value="{{ old('first_name') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputLastName">Last Name</label>
				                <input type="text" name="last_name" class="form-control" id="exampleInputLastName" placeholder="Enter Last Name" value="{{ old('last_name') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputPhone">Phone</label>
				                <input type="tel" name="phone" class="form-control" id="exampleInputPhone" placeholder="Enter Last Name" value="{{ old('phone') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputEmail1">Email address</label>
				                <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Enter email" value="{{ old('email') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputSpecialization">Specialization</label>
				                <select name="specialization" class="form-control" id="exampleInputSpecialization">
				                	<option selected disabled>Choose...</option>
				                	@foreach($specializations as $specialization)
				                		<option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
				                	@endforeach
				                </select>
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputStart">Start</label>
				                <input type="time" name="doctor_start" class="form-control" id="exampleInputStart" value="{{ old('doctor_start') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputEnd">End</label>
				                <input type="time" name="doctor_end" class="form-control" id="exampleInputEnd" value="{{ old('doctor_end') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputPassword1">Password</label>
				                <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
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