@extends('front.master')

@section('content')
<link type="text/css" href="{{Config::get('app.url')}}/theme/css/templatemo-style.css" rel="stylesheet"/>
<div class="greyBg">
    <div class="container">
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{url('/')}}">Home </a></li>
                            <li><span class="dot">/</span>
                            <li><a href="">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 mx-auto tm-login-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="tm-block-title mb-4">Welcome to Login Page</h2>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="{{ route('login') }}" method="post" class="tm-login-form">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-block text-uppercase"
                                                    >
                                                Login
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="mt-5 btn btn-primary btn-block text-uppercase" href="{{ url('/register') }}">
                                                Sign Up?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="mt-5 btn btn-primary btn-block text-uppercase" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
