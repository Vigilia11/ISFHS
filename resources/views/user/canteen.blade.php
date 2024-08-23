@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/canteen.css') }}">
    <div class="container-fluid h-100">
        <div class="w-100 h-100">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="w-100 py-3 mt-3">
                        <div class="row">
                            <div class="col-md-3 mb-3">
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
                            <div class="col-md-3 mb-3">
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
                            <div class="col-md-4 search mb-3 offset-md-2">
                                <form action="{{ url('/searchCanteen') }}" method="post" id="formSearch">
                                    @csrf
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
                    </div>
                    <div class="row g-3 facilities mb-3" id="facilities">
                        
                    </div>
                    
                </div>
            </div>
        </div>    
    </div>
    <script src="{{ asset('js/user/canteen.js') }}" defer></script>
@endsection