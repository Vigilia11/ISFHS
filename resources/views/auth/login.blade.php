@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 bg-white shadow py-5 mt-4 login-container">
            <h2 class="text-center fw-bold" style="letter-spacing:5px">ISFHS</h2>
                                
                                <form method="POST" action="{{ route('login') }}" class="mt-3" style="border-bottom:1px solid #9ca3af; padding-bottom:30px;">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="" class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-sm text-white rounded w-100 btn-login">Login</button>
                                    @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>
                                    @endif
                                    
                                </form>
                                <div class="text-center" style="margin-top:-12px;">
                                    <span class="bg-white px-3" style="color:#374151">don't have an account?</span>
                                </div>
                                <div class="text-center mt-2">
                                    <a href="{{ route('registration.create') }}" class="btn btn-sm w-100 mt-2 btn-register">Register</a>
                                </div>
            </div>
        </div>
    </div>
@endsection
