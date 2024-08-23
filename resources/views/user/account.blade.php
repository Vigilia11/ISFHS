@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/account.css') }}">
    <div class="container-fluid">
        <div class="col-md-8 offset-md-2 mt-4 bg-white rounded p-3">
            <div class="w-100 d-flex">
                <div class="div-account-status">
                    <label class="label-account-status">Account Status</label><br>
                    <label class="account-status">Pending</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 mb-4 overflow-hidden">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <img src="" class="profile-picture" alt=""><br>
                    </div>
                </div>
                <div class="col-md-7 profile-info mb-4">
                    <div class="mb-3">
                        <label class="name">Full name</label><br>
                        <label class="email">email</label>
                    </div>
                    <div class="biodata mb-4">
                        mobile number <br>
                        sex <br>
                        birthdate <br>
                        barangay, city, province
                    </div>
                    
                    <div class="row id g-4 mb-3">
                        <div class="col-md-3">
                            <h6>Front Id</h6>
                            <div class="w-100 bg-blue-100 rounded overflow-hidden">
                                <a href="" class="w-100 front-id-link" target="_blank">
                                    <img src="" class="front-id w-100" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h6>Back Id</h6>
                            <div class="w-100 bg-blue-100 rounded overflow-hidden">
                                <a href="" class="w-100 back-id-link" target="_blank">
                                    <img src="" class="back-id w-100" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <button type="button" class="button btn-slate button-sm w-100" data-bs-target="#modalProfilePicture" data-bs-toggle="modal">Change Profile Picture</button>
                </div>
                @if( auth::user()->account->status == "Pending")
                <div class="col-md-4 mb-3">
                    <button type="button" class="button btn-slate button-sm w-100" data-bs-target="#modalEditProfileInfo" data-bs-toggle="modal">Change Profile Info</button>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="button" class="button btn-slate button-sm w-100" data-bs-target="#modalChangeId" data-bs-toggle="modal">Change Pesonal Id</button>
                </div>                    
                @endif
            </div>
            
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-sm" id="modalProfilePicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalProfilePictureLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalProfilePictureLabel">Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/updateProfilePicture') }}" method="post" enctype="multipart/form-data" id="updateProfilePicture">
                @csrf
                <div class="modal-body">
                    <div class="w-100 bg-blue-100 mb-2" style="height:250px">
                        <img src="" class="w-100 h-100 profile-picture-preview" id="profile_picture_preview" alt="">
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" accept="image/*" name="profile_picture" id="profile_picture" required>
                        <span class="error profile_picture_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-blue">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="modalEditProfileInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditProfileInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditProfileInfoLabel">Edit Profile Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="updateProfileInfo" method="post" id="formEditProfileInfo">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                            <span for="" class="err_first_name error"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                            <span for="" class="err_last_name error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="11" class="form-control" name="mobile_number" id="mobile_number" required>
                            <span for="" class="err_mobile_number error"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                            <span for="" class="err_birthdate error"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Sex</label>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="male" value="Male" required>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="female" value="Female" required>
                                    <label class="form-check-label" for="male">Female</label>
                                </div>
                            </div>
                            <span for="" class="err_sex error"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="barangay" class="form-label">barangay</label>
                            <input type="text" class="form-control" name="barangay" id="barangay" required>
                            <span for="" class="err_barangay error"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="city" required>
                            <span for="" class="err_city error"></span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" name="province" id="province" required>
                            <span for="" class="err_province error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded py-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-blue rounded py-1" >Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="modalChangeId" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalChangeIdLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalChangeIdLabel">Change Id</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/updateId') }}" method="post" enctype="multipart/form-data" id="updateId">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="col-md-10 div-front-id bg-blue-100 mb-2">
                                <img src="" class="w-100 h-100 front-id-preview" id="front_id_preview" alt="">
                            </div>
                            <label for="front_id" class="form-label">Front Id</label>
                            <input type="file" accept="image/*" name="front_id" id="front_id" class="form-control" required>
                            <span class="error front_id_error"></span>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-10 div-back-id bg-blue-100 mb-2">
                                <img src="" class="w-100 h-100 back-id-preview" id="back_id_preview" alt="">
                            </div>
                            <label for="back_id" class="form-label">Back Id</label>
                            <input type="file" accept="image/*" name="back_id" id="back_id" class="form-control" required>
                            <span class="error back_id_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded py-1" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-blue rounded py-1" >Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/user/account.js') }}" defer></script>
@endsection