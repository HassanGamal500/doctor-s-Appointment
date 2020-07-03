@extends('admin.common.index')
@section('page_title')
  Add Patient
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Add New Patient</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	          		<li class="breadcrumb-item"><a href="{{route('patients')}}">Patients</a></li>
	          		<li class="breadcrumb-item active">Add New Patient</li>
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
		          	<form role="form" id="quickForm" method="post" action="{{route('store_patient')}}">
		          		@CSRF
			            <div class="card-body">
			            	<div class="form-group">
				                <label for="exampleInputUsername">Username</label>
				                <input type="text" name="username" class="form-control" id="exampleInputUsername" placeholder="Enter Username" value="{{ old('username') }}">
			              	</div>

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
				                <label for="exampleInputBD">Birth Of Date</label>
				                <input type="date" name="birth_of_date" class="form-control" id="exampleInputBD" value="{{ old('birth_of_date') }}">
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputGender">Gender</label>
				                <select name="gender" class="form-control" id="exampleInputGender">
				                	<option selected disabled>Choose...</option>
				                	<option value="male">Male</option>
				                	<option value="female">Female</option>
				                </select>
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputCountry">Country</label>
				                <select name="country" class="form-control" id="exampleInputCountry">
				                	<option selected disabled>Choose...</option>
				                	@foreach($countries as $country)
				                		<option value="{{ $country->id }}">{{ $country->name }}</option>
				                	@endforeach
				                </select>
			              	</div>

			              	<div class="form-group">
				                <label for="exampleInputOccupation">Occupation</label>
				                <input type="text" name="occupation" class="form-control" id="exampleInputOccupation" placeholder="Enter Last Name" value="{{ old('occupation') }}">
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