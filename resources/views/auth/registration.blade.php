@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/registration/registration.css') }}">
    <div class="container-fluid content">
        <row class="row justify-content-center">
            <div class="col-md-7">
                <div class="row justify-content-center gap-2">
                    <div class="col-md-5 div-student bg-white shadow">
                        <a class="w-100" href="{{ url('studentRegistration') }}">
                            <div class="w-100">
                                <h3 class="px-2 pt-2">Student</h3>
                                <img src="{{ asset('image/student.png') }}" class="w-100 img-student" alt="">
                                <p class="pt-2 pb-3">
                                    Student account can view facilities and can interact with facilitator.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5 div-facilitator bg-white shadow">
                        <a class="w-100" href="{{ url('facilitatorRegistration') }}">
                            <div class="w-100">
                                <h3 class="px-2 pt-2">Facilitator</h3>
                                <img src="{{ asset('image/facilitator.jpg') }}" class="w-100 img-facilitator" alt="">
                                <p class="pt-2 pb-3">
                                Facilitator account displays and manages facility/facilities.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </row>
    </div>
@endsection