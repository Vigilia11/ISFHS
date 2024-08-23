@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/viewFacility.css') }}">
    <div class="container-fluid bg-white pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 facility-info d-flex align-items-center">
                        <div>
                            <input type="hidden" name="hidden_facility_id" value="{{ $facility_id }}" id="hidden_facility_id">
                            <h2 style="color:#111827;"><b>Facility Name</b></h2>
                            <div class="w-100 d-flex gap-2 facilitator">
                                <img src="" class="" alt="">
                                <div class="facilitator-info">
                                    
                                </div>
                            </div>
                            <div class="facility-address">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 facility-picture-container position-relative d-flex justify-content-center align-items-center">
                        <div class="facility-picture">
                            <img src="" class="shadow" alt="">
                            <div class="star py-1" onclick="rate()">
                                                                
                            </div>
                        </div>
                        <div class="box-1"></div>
                    </div>
                </div>
                <div class="row feature-row">
                    <div class="col-md-1 fw-bold">Features: </div>
                    <div class="col-md-11">
                        <ul class="d-flex flex-wrap gap-3" id="features">
                            
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>            
    </div>
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
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
    <!-- script -->
    <script src="{{ asset('js/user/viewFacility.js') }}" defer></script>
@endsection