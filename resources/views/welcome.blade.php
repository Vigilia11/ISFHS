@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <div class="container-fluid position-absolute top-0 h-100 position-relative overflow-hidden">
        <div class="ball position-absolute"></div>
        <div class="row justify-content-center" style="margin-top:130px">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 col-left d-flex align-items-center">
                        <div>
                            <h1 class="fw-bold mb-3">Information System on <br> Foods and Housing Services</h1>
                            <p>
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque aspernatur quam libero necessitatibus repellat harum asperiores animi quisquam molestiae perferendis earum iste quia aliquid maxime laudantium sunt, accusantium esse veniam.
                            </p>
                            <div class="text-black" style="letter-spacing:5px;">
                                <b style="letter-spacing:1px" id="btnSabe">Follow us</b>
                                <i class="fa fa-facebook-official" style="" aria-hidden="true"></i>
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative overflow-hidden col-right">
                        <div class="top-rated-card bg-white rounded overflow-hidden shadow">
                            @foreach($topRated as $ratedFacility)
                            <div class="top-rated-card-picture w-100 d-flex align-items-center" style="height:60%;background-image: url({{ asset('images/facility/'.$ratedFacility->facility_picture) }});background-size: cover;">
                                
                                <div class="d-block ps-1 " style="line-height: 5px;">
                                    <h3>{{ $ratedFacility->name }}</h3>
                                    <h4 >{{ $ratedFacility->type }}</h4>
                                </div>
                            </div>
                            <div class="p-2">
                                <div class="text-end">
                                    @for($s=1;$s<=$ratedFacility->avgRates;$s++)
                                        <i class="fa fa-star checked" aria-hidden="true"></i>
                                    @endfor
                                </div>
                                <p style="line-height:20px"><small>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Debitis corporis aspernatur perspiciatis nulla itaque in voluptatum voluptates, distinctio enim id accusamus culpa similique iure repudiandae voluptate nesciunt neque doloribus quisquam!</small></p>
                            </div>
                            @endforeach
                        </div>
                        @foreach($oldFacility as $oFacility)
                        <div class="card-top-right bg-blue-100 overflow-hidden shadow"
                        style="background-image: url({{ asset('images/facility/'.$oFacility->facility_picture) }});background-size: cover;">
                        <div class="position-absolute px-2 fw-bold" style="font-size:12px;bottom:3px; right: -2px;background-color:rgba(255, 255, 255, 0.7)"><small>Old Facility</small></div>
                        </div>
                        @endforeach

                        <div class="card-bottom-right bg-white rounded overflow-hidden shadow">
                            @foreach($mostReviews as $mostReview)
                            <img src="{{ asset('images/facility/'.$mostReview->facility_picture) }}" alt="" class="w-100 h-50">
                            <div class="py-1 px-2 h-50 w-100 position-relative" style="font-size:12px;">
                                <span><b>{{ $mostReview->name }}</b></span><br>
                                <span class="position-absolute" style="bottom:2px; right: 5px">{{ $mostReview->review }} comments</span>
                            </div>
                            @endforeach
                        </div>

                        @foreach($newFacility as $nFacility)
                        <div class="card-left-center bg-white overflow-hidden shadow"
                        style="background-image: url({{ asset('images/facility/'.$nFacility->facility_picture) }});background-size: cover;">
                            <div class="position-absolute px-2 fw-bold" style="font-size:12px;bottom:3px; right: -2px;background-color:rgba(255, 255, 255, 0.7)"><small>New Facility</small></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection