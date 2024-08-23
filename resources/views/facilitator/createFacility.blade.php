@extends('layouts.app')

@section('content')
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 py-3 px-4 bg-white shadow-sm">
                <h3>CREATE FACILITY</h3>
                <form action="" class="w-100" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3" >
                                <div class="w-100">
                                    <div class="border border-secondary" style="width: 250px; height:253px">
                                        <img src="" alt="Facility Picture"  class="w-100 h-100 img-add" id="facilty_preview">
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="form-label">Facility Picture</label>
                                    <input type="file" accept="image/*" class="form-control @error('facility_picture') is-invalid @enderror" name="facility_picture" id="facility_picture" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Facility Type</label>
                                <select name="facility_type" id="type" class="form-select">
                                    <option value=""></option>
                                    <option value="Dormitory">Dormitory</option>
                                    <option value="Canteen">Canteen</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Facility Name</label>
                                <input type="text" name="facility_name" id="facility_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" name="street" id="street" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="barangay" class="form-label">Barangay</label>
                                <input type="text" name="barangay" id="barangay" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" name="province" id="province" class="form-control">
                            </div>
                        </div>
                        <div class="w-100 text-end">
                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection