@extends('layouts.app')
@section('content')
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

    <div class="container-fluid mb-3">
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <div class="w-100 account-status-pending bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="facility-pending-number"></h4>
                        <small class="account-status">Pending Facility</small>
                    </div>
                </div>
                <div class="w-100 facility-pending px-3 py-2">
                    Facility
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-100 account-status-approved bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="facility-approved-number"></h4>
                        <small class="account-status">Approved Facility</small>
                    </div>
                </div>
                <div class="w-100 facility-approved px-3 py-2">
                    Facility
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-100 account-status-declined bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="facility-declined-number"></h4>
                        <small class="account-status">Declined Facility</small>
                    </div>
                </div>
                <div class="w-100 facility-declined px-3 py-2">
                    Facility
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-100 account-status-blocked bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="facility-blocked-number"></h4>
                        <small class="account-status">Blocked Facility</small>
                    </div>
                </div>
                <div class="w-100 facility-blocked px-3 py-2">
                    Facility
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="w-100 bg-white p-3 shadow">
                    <h1>Dormitory</h1>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Pending: <span id="pendingDormitory"></span>
                        </div>
                        <div class="col-md-3">
                            Approved: <span id="approvedDormitory"></span>
                        </div>
                        <div class="col-md-3">
                            Declined: <span id="declinedDormitory"></span>
                        </div>
                        <div class="col-md-3">
                            Blocked: <span id="blockedDormitory"></span>
                        </div>
                    </div>
                    <div class="w-100 text-center">
                        Total: <span id="totalDormitory"></span>
                    </div>  
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-100 bg-white p-3 shadow">
                    <h1>Canteen</h1>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Pending: <span id="pendingCanteen"></span>
                        </div>
                        <div class="col-md-3">
                            Approved: <span id="approvedCanteen"></span>
                        </div>
                        <div class="col-md-3">
                            Declined: <span id="declinedCanteen"></span>
                        </div>
                        <div class="col-md-3">
                            Blocked: <span id="blockedCanteen"></span>
                        </div>
                    </div>
                    <div class="w-100 text-center">
                        Total: <span id="totalCanteen"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <div class="w-100 account-status-pending bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="pending-number">0</h4>
                        <small class="account-status">Pending Account</small>
                    </div>
                </div>
                <div class="w-100 account-pending px-3 py-2">
                    Account
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-100 account-status-approved bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="approved-number">0</h4>
                        <small class="account-status">Approved Account</small>
                    </div>
                </div>
                <div class="w-100 account-approved px-3 py-2">
                    Account
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-100 account-status-declined bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="declined-number">0</h4>
                        <small class="account-status">Declined Account</small>
                    </div>
                </div>
                <div class="w-100 account-declined px-3 py-2">
                    Account
                </div>
            </div>
            <div class="col-md-3">
                <div class="w-100 account-status-blocked bg-white shadow">
                    <div class="p-3 account-body">
                        <h4 class="blocked-number">0</h4>
                        <small class="account-status">Blocked Account</small>
                    </div>
                </div>
                <div class="w-100 account-blocked px-3 py-2">
                    Account
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="w-100 bg-white p-3 shadow">
                    <h1>Student</h1>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Pending: <span id="pendingStudent"></span>
                        </div>
                        <div class="col-md-3">
                            Approved: <span id="approvedStudent"></span>
                        </div>
                        <div class="col-md-3">
                            Declined: <span id="declinedStudent"></span>
                        </div>
                        <div class="col-md-3">
                            Blocked: <span id="blockedStudent"></span>
                        </div>
                    </div>
                    <div class="w-100 text-center">
                        Total: <span id="totalStudent"></span>
                    </div>  
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="w-100 bg-white p-3 shadow">
                    <h1>Facilitator</h1>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Pending: <span id="pendingFacilitator"></span>
                        </div>
                        <div class="col-md-3">
                            Approved: <span id="approvedFacilitator"></span>
                        </div>
                        <div class="col-md-3">
                            Declined: <span id="declinedFacilitator"></span>
                        </div>
                        <div class="col-md-3">
                            Blocked: <span id="blockedFacilitator"></span>
                        </div>
                    </div>
                    <div class="w-100 text-center">
                        Total: <span id="totalFacilitator"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- script -->
    <script src="{{ asset('js/admin/dashboard.js') }}" defer></script>
@endsection