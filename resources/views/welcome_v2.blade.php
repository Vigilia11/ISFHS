@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-7 system-info">
                        <div class="pe-5 ps-2">
                            <h1 class="fw-bold" style="">Information System on <br>
                                Food and Housing Services
                            </h1>
                            <p class="py-3">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe hic veritatis blanditiis sunt aliquid in itaque accusamus vel facilis, nisi animi ea laudantium aut, enim quisquam veniam recusandae totam voluptate.
                            </p>
                            <div class="text-black" style="letter-spacing:5px;">
                                <b style="letter-spacing:1px">Follow us</b>
                                <i class="fa fa-facebook-official" style="" aria-hidden="true"></i>
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 bg-white px-3 py-5 shadow login-container">
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
        </div>
    </div>
@endsection