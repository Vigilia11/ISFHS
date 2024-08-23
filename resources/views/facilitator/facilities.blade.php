@extends('layouts.app')

@section('content')
    <style>
        .link-button{
            background-color: #65a30d;
        }
        .link-button:hover{
            background-color: #3f6212;
        }
        .facility-card{
            height: 300px;
        }
    </style>
    <div class="container-fluid pt-3">
        <div class="row justify-content-center">
            <div class="col-md-10 p-3 position-relative">
                <h3>FACILITY</h3>
                <div class="toast position-absolute top-0 end-0" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">ISFHS</strong>
                        <small class="text-muted">just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        
                    </div>
                </div>
                <button type="button" class="btn btn-sm bg-indigo-500 text-white" data-bs-toggle="modal" data-bs-target="#facilityModal">Add Facility</button>
                <div class="row" id="facility">
                    
                </div>
                
            </div>
        </div>
    </div>
    <!--Modal-->
    <div class="modal" tabindex="-1" id="facilityModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Choose Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a href="{{ route('dormitory.create') }}" class="btn link-button text-white mx-1" style="text-decoration:none;">Dormitory</a>
                        <a href="{{ route('canteen.create') }}" class="btn link-button text-white mx-1" style="text-decoration:none;">Canteen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="ModalDeleteLabel">Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want delete this facility?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-sm px-3" id="ModalDeleteButtonYes" value="">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/facility/ownedFacilities.js') }}" defer></script>
@endsection