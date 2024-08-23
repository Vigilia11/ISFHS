@extends('layouts.app')

@section('content')
<div class="home-body-container container my-3">
    <div class="w-100 text-center">
        <h3>Your account is {{ Auth::user()->account->status }}.</h3>
        @if( Auth::user()->account->status == "Declined")
            <p>
                Your user account had been declined due to invalid data you have submitted. <br>
                Please check your notification and edit the invalid data that you have submitted.
            </p>
        @endif
        @if( Auth::user()->account->status == "Pending")
            <p>
                Your account has been submitted to the admin. Please wait for the admin to review your account.
            </p>
        @endif
        @if( Auth::user()->account->status == "Blocked")
            <p>
                Your account has been reported because of your inappropriate behaviour.
                The admin reviewed your account's acitivity and decided to blocked your account.
            </p>
        @endif
    </div>
</div>
@endsection
