@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/admin/facilities.css') }}">
    <div class="container-fluid">
        <input type="hidden" value="Canteen" id="facilityType" name="facilityType">
        <div class="row">
            <div class="col-md-8 filter">
                <div class="row mb-3">
                    
                    <input type="hidden" value="facilitator" name="userType" id="userType">
                    <div class="col-md-4">
                        <div class="row">
                            <label for="filterFacilityStatus" class="col-md-5 col-form-label col-form-label-sm">Facility Status</label>
                            <div class="col-md-7">
                                <select class="form-select form-select-sm bg-white" id="filterFacilityStatus" onchange="filterFacilityStatus(event)" aria-label=".form-select-sm example" id="filter">
                                    <option value="" selected></option>
                                    <option value="All">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Declined">Declined</option>
                                    <option value="Blocked">Blocked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <label for="filterFacilityStatus" class="col-md-3 col-form-label col-form-label-sm">Rate</label>
                            <div class="col-md-9">
                            <select class="form-select form-select-sm bg-white" id="filter" onchange="filterRates(event)" aria-label=".form-select-sm example" id="filter">
                                <option value="" selected></option>
                                <option value="5 star">5 star</option>
                                <option value="4 star">4 star</option>
                                <option value="3 star">3 star</option>
                                <option value="2 star">2 star</option>
                                <option value="1 star">1 star</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <label for="filterFacilityRate" class="col-md-3 col-form-label col-form-label-sm">Date</label>
                            <div class="col-md-9">
                                <select class="form-select form-select-sm bg-white" id="filter" onchange="filterDate(event)" aria-label=".form-select-sm example" id="filter">
                                    <option value="" selected></option>
                                    <option value="Ascending">Ascending</option>
                                    <option value="Descending">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 search mb-3">
                <form action="{{ url('/searchFacility') }}" method="post" id="formSearch">
                    @csrf
                    <input type="hidden" value="Canteen" name="facility_type" required>
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <input type="text" class="form-control form-control-sm bg-white" name="search" id="inputSearch" placeholder="Write something" required>
                        </div>
                        <div class="col-md-3 text-end">
                            <button type="submit" class="btn btn-sm btn-primary px-3  round">Search</button>
                        </div>                        
                    </div>
                </form>
            </div>
        </div>
        <div class="row g-2" id="facilities">
            
        </div>
    </div>

    <!-- script -->
    <script src="{{ asset('js/admin/facilities.js') }}" defer></script>
@endsection