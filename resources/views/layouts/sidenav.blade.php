<!-- sidenav -->
<link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">

<div class="sidenav h-100 bg-white shadow px-3" id="sidenav">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <a href="" class="py-1 px-3"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    <a href="" class="py-1 px-3"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
    <a href="" class="py-1 px-3"><i class="fa fa-users" aria-hidden="true"></i> Users</a>
    <a href="" class="py-1 px-3"><i class="fa fa-building-o" aria-hidden="true"></i> Facility</a> -->
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-home me-2" aria-hidden="true" style="width:16px; height:16px;"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-tachometer me-2" aria-hidden="true" style="width:16px; height:16px;"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-bell me-2" aria-hidden="true" style="width:16px; height:16px;"></i> Notification
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#user-collapse" aria-expanded="false" aria-controls="user-collapse">
                <i class="fa fa-users me-2" aria-hidden="true" style="width:16px; height:16px;"></i> Users
            </a>
            <div class="collapse" id="user-collapse">
                <ul class="list-unstyled">
                    <li class="nav-item">
                        <a href="{{ route('facilitators.index') }}" class="nav-link ms-4">Facilitator</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link ms-4">Student</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#facility-collapse" aria-expanded="false" aria-controls="facility-collapse">
                <i class="fa fa-building-o me-2" aria-hidden="true" style="width:16px; height:16px;"></i> Facilities
            </a>
            <div class="collapse" id="facility-collapse">
                <ul class="list-unstyled">
                    <li class="nav-item">
                        <a href="{{ route('dormitories') }}" class="nav-link ms-4">Canteen</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dormitories') }}" class="nav-link ms-4">Dormitory</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>