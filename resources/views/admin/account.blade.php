@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/facilitator.css') }}">
    <div class="container-fluid">
    @foreach($account as $user)
        <div class="row justify-content-center">
            <div class="col-md-9 bg-white shadow mb-3 px-3 py-5" style="boder:1px solid #e5e7eb">
                <div class="row">
                    <div class="col-md-7">
                        <div class="w-100">
                            <div class="fullname mb-4" style="">
                                <b>{{ $user->first_name }} {{ $user->last_name }}</b><br>
                                <span class="email">{{ $user->email }}</span>
                            </div>
                            <div class="personal-info">
                                {{ $user->birthdate }} <br>
                                {{ $user->sex }} <br>
                                {{ $user->mobile_number }} <br>
                                {{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 d-flex justify-content-center align-items-center">
                        <div class="profile-picture">
                            <img src="{{ asset('images/user/'.$user->profile_picture) }}" class="w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
                <div class="mb-1 text-secondary account-status-display">
                    Account Status: {{ $user->account_status }}
                </div>
                <div class="w-100 action-button">
                    <input type="hidden" name="hidden_user_id" value="{{ $user->user_id }}" id="hidden_user_id">
                    <input type="hidden" name="hidden_account_id" id="hidden_account_id" value="{{ $user->account_id }}">
                    <button type="button" onclick="approve()" class="btn-box btn-approve">Approve</button>
                    <button type="button" class="btn-box btn-decline" onclick="decline()">Decline</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalBlock" class="btn-box btn-block">Block</button>
                </div>
            </div>

            <div class="col-md-9 bg-white shadow mb-5 p-3 " style="boder:1px solid #e5e7eb">
                <div class="row g-3">
                    <img src="{{ asset('images/id/'.$user->front_id) }}" alt="" class="col-md-6" style="height:400px">
                    <img src="{{ asset('images/id/'.$user->back_id) }}" alt="" class="col-md-6" style="height:400px">
                </div>
            </div>
        </div>
        @endforeach    
    </div>

    <!-- modal -->
    <!-- Modal decline -->
    <div class="modal fade" id="modalDecline" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeclineLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-red-500 text-white">
                    <h1 class="modal-title fs-5" style="" id="modalDeclineLabel">Decline Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/declineAccount') }}" method="post" id="formDecline">
                    @csrf
                    
                    <div class="modal-body">
                        <div class="fw-bold">
                            Invalid data for
                        </div>
                        <input type="hidden" name="user_id" value="" id="user_id" required>
                        <input type="hidden" name="account_id" value="" id="account_id" required>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="email" value="Email" id="email">
                            <label class="form-check-label" for="email">
                                Email
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="fullname" value="Fullname" id="fullname" >
                            <label class="form-check-label" for="fullname">
                                Fullname
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="birthdate" value="Birthdate" id="birthdate" >
                            <label class="form-check-label" for="birthdate">
                                Birthdate
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="mobile_number" value="Mobile Number" id="birthdate">
                            <label class="form-check-label" for="mobile_number">
                                Mobile Number
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
                            <input class="form-check-input" type="checkbox" name="profile_picture" value="Profile Picture" id="profile_picture" >
                            <label class="form-check-label" for="profile_picture">
                                Profile Picture
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="front_id" value="Front ID" id="front_id" >
                            <label class="form-check-label" for="front_id">
                                Front ID
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="back_id" value="Back ID" id="back_id">
                            <label class="form-check-label" for="back_id">
                                Back ID
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
                    <h1 class="modal-title fs-5" id="modalBlockLabel">Block Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to block this account.
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="button btn-black" onclick="block()" id="btn_block">Block</button>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('js/admin/user.js') }}" defer></script>
@endsection