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
                                
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="w-100" id="facility_info"></div>
                        <div class="w-100 position-relative">
                            <h5>Features</h5>
                            
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
                        <div class="d-flex h-auto bg-white">
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

    <div class="modal fade" id="modalDeleteComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteCommentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    Do you want to delete this comment?
                    <form action="{{ url('/deleteComment') }}" method="post" id="formDeleteComment">
                        @csrf
                        <input type="hidden" name="comment_id" value="" id="comment_id">
                        <div class="mt-3 text-center">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </form>
                </div>            
            </div>
        </div>
    </div>

    
    <!-- Script -->
    <script src="{{ asset('js/viewFacility.js') }}" defer></script>

@endsection