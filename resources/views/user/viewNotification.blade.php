@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/user/viewNotification.css') }}">
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            @foreach($notification as $data)
            <div class="col-md-7 bg-white p-3 content">
                <div class="row mb-3 sender-container">
                    <div class="col-md-1">
                        <img src="{{ asset('images/user/'.$data->profilePicture) }}" class="sender-img" alt="">
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="sender w-100">
                            <span>{{ $data->first_name }} {{ $data->last_name }}</span><br>
                            <small>To: me</small>
                        </div>
                    </div>
                    <div class="col-md-3 date-top text-end">
                        <small>{{ $data->created_at }}</small>
                    </div>
                </div>
                <div class="w-100 message">
                    <div class="col-11 offset-1">{{ $data->message }}</div>
                </div>
                <div class="date-bottom text-end">
                    <small>{{ $data->created_at }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection