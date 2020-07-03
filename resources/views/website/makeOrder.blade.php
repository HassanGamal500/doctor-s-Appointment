@extends('home')
@section('title')
	Make Order
@endsection
@section('content')
<div class="container bootstrap snippet">
<br>
<h1 class="mb-5 text-center">Book With Doctors</h1>
<div class="row">
	<div class="col-sm-12">
  	<form class="form" id="makeOrder">
  		@CSRF
      	<div class="form-group">
        	<div class="col-xs-6">
          	<label for="country"><h4>Choose Your Pain...</h4></label>
          	<select class="custom-select" name="pain">
      		    <option selected disabled>Choose...</option>
      		    @foreach($pains as $pain)
      		    <option value="{{ $pain->id }}">{{ $pain->name }}</option>
      		    @endforeach
  	        </select>
        	</div>
      	</div>

        <div class="form-group">
          <div class="col-xs-6">
            <label for="comment"><h4>Leave Comment If You Want (Optional)</h4></label>
            <textarea type="text" class="form-control" name="comment" id="comment" placeholder="comment"></textarea>
          </div>
        </div>

      	<div class="form-group">
         	<div class="col-xs-12">
            <br>
          	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> OK</button>
          </div>
      	</div>
  		</form>
    </div>
</div>
@endsection