@extends('layouts.app')

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
    @CSRF
    
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <span class="login100-form-title p-b-43">
        Register to continue
    </span>
    
    
    <div class="wrap-input100 validate-input" data-validate="Username is required">
        <input class="input100" type="text" id="username" name="username" value="{{ old('username') }}" autofocus>
        <span class="focus-input100"></span>
        <span class="label-input100">UserName</span>
    </div>
    
    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password" id="password">
        <span class="focus-input100"></span>
        <span class="label-input100">Password</span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="confirm Password is required">
        <input class="input100" type="password" name="password_confirmation" id="password-confirm">
        <span class="focus-input100"></span>
        <span class="label-input100">Confirm Password</span>
    </div>

    <div class="flex-sb-m w-full p-t-3 p-b-32">
        <div>
            <a href="{{ route('login') }}" class="txt1">
                Already Have Account?
            </a>
        </div>
    </div>


    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Register
        </button>
    </div>
</form>
@endsection
