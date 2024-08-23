<link rel="stylesheet" href="{{ asset('css/sidenav_v2.css') }}">

<div class="bg-white shadow" id="sidenav">
    <div class="vh-100 position-relative w-100">
        <div class="text-end pt-2 pe-3">
            <span style="font-size:30px;cursor:pointer" onclick="hideSidenav()">&times;</span>
        </div>

        <ul class="nav flex-column overflow-hidden mt-4">
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link">
                    <i class="fa fa-home me-2" aria-hidden="true" style="width:16px; height:16px;"></i> Home
                </a>
                
            </li>
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link">
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
                            <a href="{{ route('facilitators.index') }}" class="nav-link" style="padding-left:35px; margin-left:30px;">Facilitator</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link" style="padding-left:35px;margin-left:30px;">Student</a>
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
                            <a href="{{ route('canteens.index') }}" class="nav-link" style="margin-left:30px;padding-left:35px">Canteen</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dormitories.index') }}" class="nav-link" style="margin-left:30px;padding-left:35px">Dormitory</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <div class="position-absolute" style="bottom:30px">
            <a href="#" class="d-block fw-bold">Account</a>
            <a class="" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
                
        </div>
    </div>
</div>