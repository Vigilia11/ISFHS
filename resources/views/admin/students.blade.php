@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 filter">
                <div class="row mb-3">
                    <label for="filter" class="col-2 col-form-label col-form-label-sm">Filter</label>
                    <input type="hidden" value="student" name="userType" id="userType">
                    <div class="col-md-10">
                        <select class="form-select form-select-sm bg-white" id="filter" onchange="filter(event)" aria-label=".form-select-sm example" id="filter">
                            <option value="All">All</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Declined">Declined</option>
                            <option value="Blocked">Blocked</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 search mb-3">
                <form action="{{ url('/searchAccount') }}" method="post" id="formSearch">
                    @csrf
                    <input type="hidden" value="student" name="accountType">
                    <div class="row">
                        <div class="col-md-10 mb-3">
                            <input type="text" class="form-control form-control-sm bg-white" name="search" id="inputSearch" placeholder="Write something" required>
                        </div>
                        <div class="col-md-2 text-end">
                            <button type="submit" class="btn btn-sm btn-primary px-3  round">Search</button>
                        </div>                        
                    </div>
                </form>
            </div>
        </div>
        <div class="row" id="users">
                @foreach($users as $student)
                    <div class="col-md-3 p-2" style="height:260px">
                            <a href="{{ url('/viewAccount/'.$student->id) }}" style="text-decoration:none;">
                            <div class="w-100 h-100 rounded bg-white shadow-sm pt-4" style="border:1px solid #e5e7eb">
                                <div class="w-100 d-flex justify-content-center">
                                    <div class="overflow-hidden" style="width:150px;height:150px;border-radius:100px;">
                                        <img src="{{ asset('images/user/'.$student->picture) }}" class="w-100 h-100" alt="">
                                    </div>
                                </div>
                                <div class="w-100 text-center mt-2" style="color:#374151;">
                                    <b>{{ $student->first_name }} {{ $student->last_name }}</b> <br>
                                    <span style="color:#6b7280;">{{ $student->status }}</span>
                                </div>
                            </div>
                            </a>
                    </div>
                @endforeach
        </div>
    </div>
    <script src="{{ asset('js/admin/users.js') }}" defer></script>
@endsection