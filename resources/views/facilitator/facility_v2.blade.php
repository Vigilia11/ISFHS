@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/facility.css') }}">    
    
     <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <img id="img-facility" src="" class="w-100" alt="" style="height:300px">
                        <input type="hidden" name="facility_id" id="facility_id" value="{{ $facility_id }}">
                        
                        <div class="mt-3 ratings position-relative">
                            <div class="toast position-absolute top-0 end-0" id="RateToast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto" id="RateToastBody"></strong>
                                    <button type="button" onclick="$('#RateToast').hide()" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>

                            <a data-bs-toggle="modal" data-bs-target="#ModalRate" class="modal-rate-trigger h5 fw-bold">
                                Reviews
                            </a>
                            <div id="starRate">
                                <i id="star1"></i>
                                <i id="star2"></i>
                                <i id="star3"></i>
                                <i id="star4"></i>
                                <i id="star5"></i>
                                <span class="average-rate">Average Rate</span>
                            </div>
                            

                            <div class="row">
                                <!--5 star -->
                                <div class="left">
                                    5 star
                                </div>
                                <div class="middle d-flex">
                                    <div class="bar-container my-auto">
                                        <div class="bar-5 h-100 bar"></div>
                                    </div>
                                </div>
                                <div class="right"><span class="5star-total"></span></div>
                                <!--4 star -->
                                <div class="left">
                                    4 star
                                </div>
                                <div class="middle d-flex">
                                <div class="bar-container my-auto">
                                        <div class="bar-4 h-100 bar"></div>
                                    </div>
                                </div>
                                <div class="right"><span class="4star-total"></span></div>
                                <!--3 star -->
                                <div class="left">
                                    3 star
                                </div>
                                <div class="middle d-flex">
                                <div class="bar-container my-auto">
                                        <div class="bar-3 h-100 bar"></div>
                                    </div>
                                </div>
                                <div class="right"><span class="3star-total"></span></div>
                                <!--2 star -->
                                <div class="left">
                                    2 star
                                </div>
                                <div class="middle d-flex">
                                <div class="bar-container my-auto">
                                        <div class="bar-2 h-100 bar"></div>
                                    </div>
                                </div>
                                <div class="right"><span class="2star-total"></span></div>
                                <!--1 star -->
                                <div class="left">
                                    1 star
                                </div>
                                <div class="middle d-flex">
                                <div class="bar-container my-auto">
                                        <div class="bar-1 h-100 bar"></div>
                                    </div>
                                </div>
                                <div class="right"><span class="1star-total"></span></div>
                            </div>
                        </div>
                        <div>
                            <div class="toast toast-picture" id="toastPicture" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto" id="pictureToastBody"></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toastPicture"   aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2 mb-5 mt-3" id="facilityPictureContainer">
                                <div class="col-md-4 p-1 order-last">
                                    <div class="w-100" style="height:200px;border:1px solid white; border:1px solid gray;border-style:dashed;">
                                        <button type="button" style="width:100%; height:100%; background-color:transparent; border:none;" data-bs-toggle="modal" data-bs-target="#modalAddPicture">
                                            <i class="fa fa-plus" style="font-size:50px" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="w-100" id="facility_info"></div>
                        <div class="w-100 position-relative">
                            <h5>Features</h5>
                            <button class="px-3 btn-add"
                            data-bs-toggle="modal" data-bs-target="#modalFeature">Add</button>
                            <button class="btn-delete px-3"
                            data-bs-toggle="modal" data-bs-target="#modalDeleteFeature">Delete</button>

                            <div class="toast position-absolute top-0 end-0" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">ISFHS</strong>
                                    <small class="text-muted">just now</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body" id="toastFeaturesBody">
                                    
                                </div>
                            </div>
                            <ul id="features"></ul>
                        </div>
                        <div class="feedback position-relative">
                            <div class="toast position-absolute end-0" style="top:-15px" id="toast_comment" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto" id="toastCommentBody"></strong>
                                    <button type="button" class="btn-close" onclick="$('#toast_comment').hide()" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                            <h5>Feedback</h5>
                            <div>
                                <form action="{{ route('comment.store') }}" method="post" id="formComment">
                                    @csrf
                                    <div class="d-flex h-auto">
                                        <div class="input-group" style="width:92%">
                                            <textarea name="comment" class="py-2 px-3 comment" placeholder="Write comment" id="comment_textarea"
                                            oninput="auto_grow(this)" required></textarea>
                                        </div>
                                        <div class="position-relative h-auto" style="width:8%">
                                            <button type="submit" class="position-absolute bottom-0 end-0 btn-comment-submit" id="btn_submit_comment">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                    <input type="hidden" name="facility_id" value="{{ $facility_id }}">
                                    <label for="" class="comment-error text-red-500" style="display:none"></label>
                                </form>
                            </div>
                            <div class="comment-container mb-5" id="commentContainer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    <!-- Modal -->
    <div class="modal fade" id="modalFeature" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFeatureLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('feature.store') }}" method="post" id="form_feature">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="modalFeatureLabel">Facility Feature</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-layout">
                        <input type="hidden" value="{{ $facility_id }}" name="fid">
                        <label for="feature" class="form-label">Feature</label>
                        <input type="text" class="form-control" minlength="4" name="feature" id="feature" required>
                        <p class="text-red-500 feature_error" style="display:none"></p>
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

    <div class="modal fade" id="ModalRate" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ModalRateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-body text-center">
                    <h5 class="fw-bold" id="ModalRateLabel">Rate</h5>
                    <form action="{{ route('rate.store') }}" method="post" id="formRate">
                        @csrf
                        <input type="hidden" name="facility_id" value="{{ $facility_id }}">
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
                            <button type="button" onclick="clearRate()" class="cancel px-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="submit px-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalDeleteComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteCommentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    Do you want to delete this comment?
                    <form action="{{ url('/deleteComment') }}" method="post" id="formDeleteComment">
                        @csrf
                        <input type="hidden" name="comment_id" value="" id="comment_id">
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalReply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Replies</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="commentor position-relative" id="modalCommentContainer">
                        
                    </div>
                    <div class="replies position-relative" id="repliesContainer">
                        
                    </div>
                    <form action="{{ route('reply.store') }}" method="post" id="formReply" class="mt-2">
                        @csrf
                        <div class="d-flex h-auto">
                            <div class="input-group" style="width:92%">
                                <textarea name="reply" class="py-2 px-3 reply" placeholder="Write reply" id="reply_textarea"
                                oninput="auto_grow(this)" required></textarea>
                            </div>
                            <div class="position-relative h-auto" style="width:8%">
                                <button type="submit" class="position-absolute btn-comment-submit bottom-0 end-0 btn-reply-submit" id="btn_submit_reply">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="comment_id" name="comment_id" value="">
                        <label for="" class="reply-error text-red-500 pt-2" style="display:none"></label>
                    </form>
                    <button type="button" class="d-none" id="btnRefreshComment">Reload Comment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                        
                        <div id="preview" class="mb-3 d-flex justify-content-center"></div>
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
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm px-2">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeletePicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeletePictureLabel" aria-hidden="true">
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
    
    
    <!-- Script -->
    
     <script src="{{ asset('js/facility/ownedFacility.js') }}" defer></script>
     <script src="{{ asset('js/facility/imagePreview.js') }}" defer></script>

@endsection