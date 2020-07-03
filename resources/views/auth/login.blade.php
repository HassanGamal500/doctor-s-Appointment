@extends('layouts.app')

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
    @CSRF

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                <li><strong>Email OR Password Is Not Correct</strong></li>
            </ul>
        </div>
    @endif
    
    <span class="login100-form-title p-b-43">
        Login to continue
    </span>
    
    
    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
        <input class="input100" type="email" id="email" name="email" value="{{ old('email') }}" autofocus>
        <span class="focus-input100"></span>
        <span class="label-input100">Email</span>
    </div>
    
    
    <div class="wrap-input100 validate-input" data-validate="Password is required">
        <input class="input100" type="password" name="password" id="password">
        <span class="focus-input100"></span>
        <span class="label-input100">Password</span>
    </div>

    <div class="flex-sb-m w-full p-t-3 p-b-32">
        <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="label-checkbox100" for="ckb1">
                Remember me
            </label>
        </div>
        <div>
            <a href="{{ route('register') }}" class="txt1">
                I Don't Have Account.
            </a>
        </div>
    </div>


    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Login
        </button>
    </div>
</form>
@endsection
