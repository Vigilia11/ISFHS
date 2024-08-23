@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/viewFacility.css') }}">
    <div class="container-fluid">
        @foreach($facility as $fty)
        <div class="row">
            <div class="col-md-6 mb-3">
                <img src="{{ asset('images/facility/'.$fty->facilityPicture) }}" class="w-100 facility-picture" alt="">
            </div>
            <div class="col-md-6 mb-3">
                <div>
                    <h2>{{ $fty->facilityName }}</h2>
                    <div class="col-md-8 ps-4">
                        <div class="row">
                            <div class="col-1">
                                <img src="{{ asset('images/user/'.$fty->profilePicture) }}" alt="" class="facilitator-picture">
                            </div>
                            <div class="col-10 d-flex align-items-center">{{ $fty->firstName }} {{ $fty->lastName }}</div>
                        </div>
                    </div>
                </div>
                <div class="w-100 pt-2">
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <small class="">5 of 10 reviews</small>
                </div>
                <div class="facility-status py-1">
                    {{ $fty->status }}
                    <input type="hidden" value="{{ $fty->facilityId }}" name="hidden_facility_id" id="hidden_facility_id">
                    <input type="hidden" value="{{ $fty->userId }}" name="hidden_user_id" id="hidden_user_id">
                </div>
                <div class="w-100 action-button mb-3">
                    <button type="button" class="btn-box btn-approve"  onclick="approve()">Approve</button>
                    <button type="button" class="btn-box btn-decline" onclick="decline()">Decline</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalBlock" class="btn-box btn-block">Block</button>
                </div>
                <div class="facility-info">
                {{ $fty->facilityType }} <br>
                {{ $fty->mobileNumber }} <br>
                {{ $fty->barangay }}, {{ $fty->city }}, {{ $fty->province }}
                </div>
                <div class="feature">
                    Feature
                    <ol>
                        @foreach($features as $feature)
                            <li>{{ $feature->feature }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        @endforeach
        <!-- pictures -->
        <div class="w-100">
            <h1>Facility Pictures</h1>
            <div class="row g-2 m-3">            
                @foreach($pictures as $picture)
                    <div class="col-md-1">
                        <a href="{{ asset('images/facility/'.$picture->image) }}" target="_blank" class="w-100">
                            <img src="{{ asset('images/facility/'.$picture->image) }}" alt="" class="w-100 img-facility-pictures">
                        </a>
                        <div class="text-center py-1">
                            <small>{{ $picture->description }}</small>
                        </div>
                    </div>
                @endforeach
            </div> 
        </div>
        <!-- permits -->
        <div class="w-100 mb-5">
            <h3>Permits</h3>
            <div class="row g-1 ">
                @foreach($permits as $permit)
                <div class="col-md-3">
                    <div class="text-center fw-bold py-1">
                        {{ $permit->name }}
                    </div>
                    <a href="{{ asset('images/facility/permit/'.$permit->picture) }}" target="_blank" class="w-100">
                        <img src="{{ asset('images/facility/permit/'.$permit->picture) }}" class="w-100 img-permit" alt="">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="modalDecline" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeclineLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-red-500 text-white">
                    <h1 class="modal-title fs-5" style="" id="modalDeclineLabel">Decline Facility</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/declineFacility') }}" method="post" id="formDecline">
                    @csrf
                    
                    <div class="modal-body">
                        <div class="fw-bold">
                            Invalid data for
                        </div>
                        <input type="hidden" name="user_id" value="" id="user_id" required>
                        <input type="hidden" name="facility_id" value="" id="facility_id" required>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facility_name" value="Facility Name" id="facility_name">
                            <label class="form-check-label" for="email">
                                Facility Name
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="barangay" value="Barangay" id="barangay" >
                            <label class="form-check-label" for="barangay">
                                Barangay
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="city" value="City" id="city" >
                            <label class="form-check-label" for="city">
                                City
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="province" value="Province" id="province" >
                            <label class="form-check-label" for="province">
                                Province
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facility_picture" value="Facility Picture" id="facility_picture" >
                            <label class="form-check-label" for="profile_picture">
                                Facility Picture
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="item_picture" value="Facility Item Picture" id="item_picture" >
                            <label class="form-check-label" for="front_id">
                                Facility Item Picture
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permit" value="Permit" id="permit">
                            <label class="form-check-label" for="back_id">
                                Permit
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="button btn-blue">Submit</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <!-- block -->
    <div class="modal fade" id="modalBlock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBlockLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalBlockLabel">Block Facility</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to block this facility.
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="button btn-black" onclick="block()" id="btn_block">Block</button>
                </div>
            </div>
        </div>
    </div>

    <!-- script -->
    <script src="{{ asset('js/admin/facility.js') }}" defer></script>
@endsection