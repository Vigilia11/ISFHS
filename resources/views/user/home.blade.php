@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/home.css') }}">
    <div class="container-fluid">
        <div class="container">
            <!-- Carousel -->
            <div id="isfhs_carousel" class="carousel carousel-dark slide mb-4 mt-2 position-relative" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#isfhs_carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#isfhs_carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#isfhs_carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active bg-white" data-bs-interval="5000">
                        <div class="w-100 h-100 d-flex align-items-center">
                            <div class="w-100 text-center carousel-item-1">
                                <h1>Information System on</h1>
                                <h1>Foods and Housing Services</h1>
                            </div>
                        </div>
                        <div class="ball-1 position-absolute"></div>
                        <div class="ball-2 position-absolute"></div>
                        
                    </div>
                    <div class="carousel-item bg-white" data-bs-interval="5000">
                        <div class="row h-100">
                            <div class="col-md-6 h-100">
                                <img src="{{ asset('images/dormitory.jpeg') }}" alt="" class="w-100 h-100">
                            </div>
                            <div class="col-md-6 h-100">
                                <div class="w-100 h-100">
                                    <div class="w-100 px-3 mt-5">
                                        <h2>Dormitory</h2>
                                        <p>
                                            ISFHS helps you to find a housing services and gives you details about the facility. You can view the most top rated, most commented, newest and old facility/facilities.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item bg-white" data-bs-interval="5000">
                        <div class="row h-100">
                            <div class="col-md-6 h-100">
                                <div class="w-100 h-100">
                                    <div class="w-100 px-3 mt-5">
                                        <h2>Canteen</h2>
                                        <p>
                                            ISFHS helps you to find a foods services and gives you details about the facility. You can view the most top rated, most commented, newest and old facility/facilities.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 h-100">
                                <img src="{{ asset('images/foods.jpeg') }}" alt="" class="w-100 h-100">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <button class="carousel-control-prev" type="button" data-bs-target="#isfhs_carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#isfhs_carousel" data-bs-slide="next">
                <button class="btn-carousel-control-next" type="button" data-bs-target="#isfhs_carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> -->
                <div class="btn-carousel-control-prev d-flex align-items-center justify-content-center" type="button" data-bs-target="#isfhs_carousel" data-bs-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <div class="btn-carousel-control-next d-flex align-items-center justify-content-center" type="button" data-bs-target="#isfhs_carousel" data-bs-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </div>
            </div>
            <!-- top rated -->
            <div class="top-rated w-100 p-2 rounded mb-4 shadow">
                <h2 class="">Top Rated Facilities</h2>
                <div class="row top-rated-content d-flex gap-1">
                    @foreach($topRated as $tr)
                    <div class="col-md-3 overflow-hidden">
                        @if($tr->type == 'Dormitory')
                        <a href="{{ url('/viewDormitory/'.$tr->id) }}" class="nav-link w-100">
                        @else
                        <a href="{{ url('/viewCanteen/'.$tr->id) }}" class="nav-link w-100">
                        @endif
                        <div class="bg-white w-100 p-4">
                            <div class="w-100 top-rated-facility position-relative overflow-hidden mb-2">
                                <div class="star-container position-absolute py-1 px-2">
                                    @for($i=1; $i<=$tr->avgRates; $i++)
                                    <i class="fa fa-star checked" aria-hidden="true"></i>
                                    @endfor
                                </div>
                                <img src="{{ asset('images/facility/'.$tr->facility_picture) }}" class="w-100 h-100" alt="">
                            </div>
                            <div class="w-100 text-center">{{ $tr->avgRates }} reviews</div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- dormitories -->
            <div class="dormitories container-fluid p-2 mb-4 bg-white shadow">
                <div class="w-100">
                    <h2>Dormitory</h2>
                </div>
                <div class="container-fluid">
                <div class="row">
                    @foreach($dormitories as $dorm)
                        <div class="col-md-3 dormitory px-3 pt-3 pb-2">
                            <a href="{{ url('/viewDormitory/'.$dorm->id) }}" class="nav-link w-100">
                            <img src="{{ asset('images/facility/'.$dorm->facility_picture) }}" class="w-100 dormitory-picture rounded" alt="">
                            <div class="w-100 dormitory-details pt-2">
                                <span>{{ $dorm->name }}</span><br>
                                <div class="star py-1">
                                    @for($i=1; $i<=$dorm->avgRates; $i++)
                                        <i class="fa fa-star checked" aria-hidden="true"></i>
                                    @endfor
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
            <!-- canteen -->
            <div class="canteens w-100 p-2 mb-4 bg-white shadow">
                <div class="w-100">
                    <h2>Canteen</h2>
                </div>
                <div class="container-fluid">
                <div class="row">
                    @foreach($canteen as $ctn)
                        <div class="col-md-3 canteen px-3 pt-3 pb-2">
                            <a href="{{ url('/viewCanteen/'.$ctn->id) }}" class="nav-link w-100">
                            <img src="{{ asset('images/facility/'.$ctn->facility_picture) }}" class="w-100 canteen-picture rounded" alt="">
                            <div class="w-100 canteen-details pt-2">
                                <span>{{ $ctn->name }}</span><br>
                                <div class="star py-1">
                                    @for($i=1; $i<=$ctn->avgRates; $i++)
                                        <i class="fa fa-star checked" aria-hidden="true"></i>
                                    @endfor
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/home.js') }}" defer></script>
@endsection