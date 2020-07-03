@extends('home')
@section('title')
	Profile
@endsection
@section('content')
<div class="container bootstrap snippet">
<br>
<div class="row">
	<div class="col-sm-12">
		<div class="alert alert-warning" role="alert">
		  	Please Fill This Form To Make Order To Get Appointement's Doctor
		</div>
      	<form class="form" id="updateProfile">
      		@CSRF
          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="first_name"><h4>First name</h4></label>
                  	<input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any." value="{{ $getUser->first_name }}">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                	<label for="last_name"><h4>Last name</h4></label>
                  	<input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any." value="{{ $getUser->last_name }}">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="phone"><h4>Phone</h4></label>
                  	<input type="tel" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any." value="{{ $getUser->phone }}">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="email"><h4>Email</h4></label>
                  	<input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email." value="{{ $getUser->email }}">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="bd"><h4>Birth Of Date</h4></label>
                  	<input type="date" class="form-control" name="birth_of_date" id="bd" title="enter Birth Of Date" value="{{ $getUser->birth_of_date }}">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="gender"><h4>Gender</h4></label>
                  	<select class="custom-select" name="gender">
					    <option selected disabled>Choose...</option>
					    <option value="male" {{ $getUser->gender == 'male' ? 'selected' : '' }}>Male</option>
					    <option value="female" {{ $getUser->gender == 'female' ? 'selected' : '' }}>Female</option>
				  	</select>
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="country"><h4>Country</h4></label>
                  	<select class="custom-select" name="country">
					    <option selected disabled>Choose...</option>
					    @foreach($getCountry as $country)
					    <option value="{{ $country->id }}" {{ $getUser->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
					    @endforeach
				  	</select>
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="occupation"><h4>Occupation</h4></label>
                  	<input type="text" class="form-control" name="occupation" id="occupation" placeholder="enter your occupation" title="enter your email." value="{{ $getUser->occupation }}">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                  	<label for="password"><h4>Password</h4></label>
                  	<input type="password" class="form-control passwordEmpty" name="password" id="password" placeholder="password" autocomplete="off">
              	</div>
          	</div>

          	<div class="form-group">
              	<div class="col-xs-6">
                	<label for="password2"><h4>Confirm Password</h4></label>
                  	<input type="password" class="form-control passwordEmpty" name="password_confirmation" id="password2" placeholder="confirm password">
              	</div>
          	</div>

          	<div class="form-group">
               	<div class="col-xs-12">
                    <br>
                  	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                   	<a class="btn btn-lg btn-danger" href="{{ URL::previous() }}"><i class="glyphicon glyphicon-repeat"></i> Cancel</a>
                </div>
          	</div>

  		</form>
    </div><!--/col-9-->
</div><!--/row-->
@endsection