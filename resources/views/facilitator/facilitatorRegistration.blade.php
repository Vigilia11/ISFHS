@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 bg-white shadow-sm py-2">
                <h2>Facilitator Registration</h2>
                <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <!--carousel-->
                    <div id="facilitatorRegistrationForm" class="carousel carousel-dark slide position-relative m-3" style="height:500px">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#facilitatorRegistrationForm" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#facilitatorRegistrationForm" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#facilitatorRegistrationForm" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>   
                        <div class="position-absolute bottom-0 end-0">
                            <button class="btn btn-sm bg-black text-white" type="button" data-bs-target="#facilitatorRegistrationForm" data-bs-slide="prev">Prev</button>
                            <button class="btn btn-sm bg-black text-white" type="button" data-bs-target="#facilitatorRegistrationForm" data-bs-slide="next">Next</button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <h5>Personal Details</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-label">First Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"  value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class="text-red-500" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="" class="form-label">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">Birthdate</label>
                                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}">
                                        @error('birthdate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">Sex</label>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sex" id="male" value="Male">
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sex" id="male" value="Female">
                                                <label class="form-check-label" for="male">Female</label>
                                            </div>
                                        </div>
                                        @error('sex')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">Mobile Number</label>
                                        <input type="text"  class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}">
                                        @error('mobile_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">Barangay</label>
                                        <input type="text" class="form-control @error('barangay') is-invalid @enderror" name="barangay" value="{{ old('barangay') }}">
                                        @error('barangay')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="province" class="form-label">Province</label>
                                        <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ old('province') }}">
                                        @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <h5>Valid ID</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="w-100">
                                            <div class="" style="height:300px">
                                                <img src="" alt="front ID picture"  class="w-100 h-100 img-add" id="front_id_preview">
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">Front ID</label>
                                            <input type="file" accept="image/*" class="form-control @error('front_id') is-invalid @enderror" name="front_id" id="front_id_picture"  value="{{ old('front_id') }}">
                                            @error('front_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="w-100">
                                            <div class="" style="height:300px">
                                                <img src="" alt="back ID picture"  class="w-100 h-100 img-add" id="back_id_preview">
                                            </div>
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">Back ID</label>
                                            <input type="file" accept="image/*" class="form-control @error('back_id') is-invalid @enderror" name="back_id" id="back_id_picture"  value="{{ old('back_id') }}">
                                            <label for="" class="text-danger message-error back_id_picture_error"></label>
                                            @error('back_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="w-100">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <h5>Account</h5>
                                            <div class="mb-3 form-group">
                                                <label for="" class="form-label">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label for="" class="form-label">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-4 form-group">
                                                <label for="" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="password_confirmation" value="{{ old('confirm_password') }}">
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="AccountType" value="facilitator">
                                            <div class="w-100 text-end">
                                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--carousel-->
                    
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/imagePreview.js') }}" defer></script>
@endsection