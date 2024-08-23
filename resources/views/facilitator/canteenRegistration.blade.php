@extends('layouts.app')

@section('content')
    <style>
        .canteen-picture{
            border: 1px solid gray;
            border-style: dashed;
            width: 150px;
            height: 200px;
        }
    </style>
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-white shadow py-3 px-4">
                <h3>Canteen Registration</h3>
                
                <form action="{{ route('canteen.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Canteen Picture</label>
                            <input type="file" accept="image/*" class="form-control" name="canteen_picture" required>
                            @error('canteen_picture')
                                <label for="" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Name of Canteen</label>
                            <input type="text" class="form-control" name="canteen_name" required>
                            @error('canteen_name')
                                <label for="" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Street</label>
                                <input type="text" class="form-control" name="street" required>
                                @error('street')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Barangay</label>
                                <input type="text" class="form-control" name="barangay" required>
                                @error('barangay')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" required>
                                @error('city')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Province</label>
                                <input type="text" class="form-control" name="province" required>
                                @error('province')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Picture of Business Permit</label>
                                <input type="file" accept="image/*" class="form-control" name="business_permit" required>
                                @error('business_permit')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Picture of Fire Safety</label>
                                <input type="file" accept="image/*" class="form-control" name="fire_safety" required>
                                @error('fire_safety')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Picture of Sanitary Permit</label>
                                <input type="file" accept="image/*" class="form-control" name="sanitary_permit" required>
                                @error('sanitary_permit')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Picture of DTI</label>
                                <input type="file" accept="image/*" class="form-control" name="DTI" required>
                                @error('DTI')
                                    <label for="" class="text-danger">{{ $message }}</label>
                                @enderror
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