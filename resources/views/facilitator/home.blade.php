@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-blue-200">
            {{ Auth::user()->account->status }}
        </div>
    </div>
</div>
@endsection
