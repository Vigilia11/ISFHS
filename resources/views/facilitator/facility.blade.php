@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/facilitator/facility.css') }}">
    <div class="container-fluid bg-white pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 facility-info d-flex align-items-center" >
                        <div>
                            <input type="hidden" name="hidden_facility_id" value="{{ $facility_id }}" id="hidden_facility_id">
                            <h2 style="color:#111827;"><b>Facility Name</b></h2>
                            <div class="star py-1" onclick="rate()"></div>
                            <div class="facility-address">
                                
                            </div>
                            <button type="button" class="button btn-slate button-sm rounded button-facility-info" onclick="editFacilityInfo()">edit</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="w-100 facility-picture-container position-relative d-flex justify-content-center align-items-center">
                            <div class="facility-picture">
                                <img src="" class="shadow" alt="" id="img-facility">
                                <div class="w-100 py-2 text-center">
                                    <button class="button button-sm btn-slate" data-bs-toggle="modal" data-bs-target="#modalUpdateFacilityPicture">upload</button>
                                </div>
                            </div>
                            <div class="box-1"></div>
                        </div>
                    </div>
                </div>
                <div class="row feature-row">
                    <div class="col-md-1 fw-bold">Features: </div>
                    <div class="col-md-11">
                        <ul class="d-flex flex-wrap gap-3" id="features">
                            
                        </ul>
                    </div>                    
                </div>
                <div class="w-100 mb-4">
                    <button type="button" class="button btn-slate button-sm rounded px-4" data-bs-toggle="modal" data-bs-target="#modalFeature">add feature</button>
                    <button type="button" class="button btn-red button-sm rounded" onclick="deleteFeatures()">delete feature</button>
                </div>
                <div class="row g-3 certificates mb-3">
                            
                </div>
            </div>
        </div>            
    </div>
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="mb-2">
                            <button type="button" class="button button-sm btn-slate rounded" data-bs-toggle="modal" data-bs-target="#modalAddPicture">Add Picture</button>
                        </div>
                        <div class="row g-1" id="facility_pictures">
                            
                        </div>
                    </div>
                    <!-- comment -->
                    <div class="col-md-6">
                        <div class="w-100 mb-3">
                            <form action="{{ route('comment.store') }}" method="post" id="formComment">
                                @csrf
                                <div class="w-100 mb-2">
                                    <div class="input-group w-100" >
                                        <textarea name="comment" class="py-2 px-3 comment" placeholder="Write comment" id="comment_textarea"
                                        oninput="auto_grow(this)" required></textarea>
                                    </div>
                                </div>
                                <div class="w-100 text-end">
                                    <button type="reset" class="button round-md btn-cancel-comment">Cancel</button>
                                    <button type="submit" class="button btn-submit-comment round-md">Comment</button>
                                </div>
                                <input type="hidden" name="facility_id" value="{{ $facility_id }}">
                                <label for="" class="comment-error text-red-500" style="display:none"></label>
                            </form>
                        </div>
                        <div class="w-100" id="commentContainer">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="ModalRate" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalRateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-body text-center">
                    <h5 class="fw-bold" id="ModalRateLabel">Rate</h5>
                    <form action="{{ route('rate.store') }}" method="post" id="formRate">
                        @csrf
                        <input type="hidden" name="facility_id" id="facility_id">
                        <input type="radio" name="rate" value="1" id="rate1" class="d-none" required>
                        <input type="radio" name="rate" value="2" id="rate2" class="d-none" required>
                        <input type="radio" name="rate" value="3" id="rate3" class="d-none" required>
                        <input type="radio" name="rate" value="4" id="rate4" class="d-none" required>
                        <input type="radio" name="rate" value="5" id="rate5" class="d-none" required>
                        <label for="rate1" class="fa-solid fa-star" id="rate1Label" onclick="rate1()"></label>
                        <label for="rate2" class="fa-solid fa-star" id="rate2Label" onclick="rate2()"></label>
                        <label for="rate3" class="fa-solid fa-star" id="rate3Label" onclick="rate3()"></label>
                        <label for="rate4" class="fa-solid fa-star" id="rate4Label" onclick="rate4()"></label>
                        <label for="rate5" class="fa-solid fa-star" id="rate5Label" onclick="rate5()"></label>
                        <div class="mt-3">
                            <button type="button" onclick="clearRate()" class="button btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="button btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalFacilityInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFacilityInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFacilityInfoLabel">Edit Facility Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="" id="formEditFacilityInfo">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="facility_name" class="form-label">Facility Name</label>
                        <input type="text" name="facility_name" id="facility_name" class="form-control" required>
                        <span class="error facility_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="street" class="form-label">Street</label>
                        <input type="text" name="street" id="street" class="form-control" required>
                        <span class="error street_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="barangay" class="form-label">Barangay</label>
                        <input type="text" name="barangay" id="barangay" class="form-control" required>
                        <span class="error barangay_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" id="city" class="form-control" required>
                        <span class="error city_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <input type="text" name="province" id="province" class="form-control" required>
                        <span class="error province_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded py-1" data-bs-dismiss="modal" onclick="$('#formEditFacilityInfo').find('span.error').text('');">Cancel</button>
                    <button type="submit" class="button btn-blue rounded py-1">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFeature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFeatureLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="modalFeatureLabel">Facility Feature</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('feature.store') }}" method="post" id="form_feature">
                @csrf
                <div class="modal-body">
                    <div class="form-layout">
                        <input type="hidden" value="{{ $facility_id }}" name="fid">
                        <label for="feature" class="form-label">Feature</label>
                        <input type="text" class="form-control" minlength="4" name="feature" id="feature" required>
                        <span class="error feature_error"></span>
                    </div>
                    <div class="mt-5 text-end">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm text-white bg-blue-500 px-3">Add</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDeleteFeature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteFeatureLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="modalFeatureLabel">Delete Feature</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formDeleteFeature">
                        @csrf
                        <div class="" id="featuresContainer">
                            
                        </div>
                        <div class="mt-5 text-end">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="btnDeleteFeature" class="btn btn-sm text-white btn-danger px-3">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddPicture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('facilityPicture.store') }}" method="post" enctype="multipart/form-data" id="formAddPicture">
                @csrf
                <div class="modal-body">  
                        <input type="hidden" name="facility_id" value="{{ $facility_id }}">
                        
                        <div id="preview" class="mb-3 d-flex justify-content-center overflow-hidden"></div>
                        <div class="mb-3">
                            <label for="" class="form-label">Picture</label>
                            <input id="files" type="file" class="form-control input" accept="image/*" name="picture" required>
                            <p class="text-red-500 picture-error error" id="picture_error" style="display:none"></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control input" required>
                            <p class="text-red-500 description-error error"  style="display:none"></p>
                        </div>
                </div>       
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                    onclick="$('#formAddPicture').find('p.error').text('');
                    $('#formAddPicture').find('input.input').val('');
                    $('#formAddPicture').find('#preview').html('');">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm px-2">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-sm" id="modalDeletePicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeletePictureLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body w-100 d-flex justify-content-center">
                    <form action="{{ url('/destroyFacilityPicture') }}" method="post" id="formDeletePicture">
                        @csrf
                        <p class="delete-confirmation-message">Are you sure you want to delete?</p>
                        <div class="w-100 d-flex justify-content-center mb-3">
                            <div class="" style="height:200px; width:200px">
                                <img src="" alt="" class="w-100 h-100 delete-confirmation-picture">
                            </div>
                        </div>
                        <input type="hidden" name="picture_id" id="picture_id">
                        <input type="hidden" name="picture_path" id="picture_path">
                        <div class="w-100 d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm text-white bg-red-500">Delete</button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-sm" id="modalUpdateFacilityPicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalChangePermitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUpdateFacilityPictureLabel">Change Facility Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/updateFacilityPicture/'.$facility_id ) }}" method="post" enctype="multipart/form-data" id="formUpdateFacilityPicture">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="w-100 facility-picture-preview-container mb-3">
                        <img src="" class="w-100 h-100" id="facility_picture_preview" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Picture</label>
                        <input id="facility_picture" type="file" class="form-control input" accept="image/*" name="facility_picture" required>
                        <span class="text-red-500 facility_picture_error error" id="facility_picture_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-blue rounded">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalChangePermit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalChangePermitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPermitName"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/updateCertificate') }}" method="post" enctype="multipart/form-data" id="formUpdateCertificate">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="facility_id" value="{{ $facility_id }}" required>
                    <input type="hidden" name="permit_id" value="" id="permit_id" required>
                    <div class="mb-3 w-100 permit-preview-div d-flex justify-content-center">
                        <img src="" alt="" class="permit-preview-img" id="permit_preview_img">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Picture</label>
                        <input id="permit" type="file" class="form-control input" accept="image/*" name="certificate" required>
                        <span class="text-red-500 permit_error error" id="permit_error"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-blue rounded">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteCommentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteCommentLabel">Delete Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/deleteComment') }}" method="post" id="formDeleteComment">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="comment_id" id="comment_id">
                    Are you sure you want to delete this comment?
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-red rounded">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteReply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteReplyLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalDeleteReplyLabel">Delete Reply</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/deleteReply') }}" method="post" id="formDeleteReply">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="reply_id" id="reply_id">
                    Are you sure you want to delete this reply?
                </div>
                <div class="modal-footer">
                    <button type="button" class="button btn-gray rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button btn-red rounded">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- script -->
    <script src="{{ asset('js/facilitator/facility.js') }}" defer></script>
    <script src="{{ asset('js/facility/imagePreview.js') }}" defer></script>
@endsection