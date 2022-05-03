@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <h1>Welcome to {{ config('app.name') }}!</h1>
                <a href="{{ route('login') }}" class="btn btn-success w-100">Login</a>
                <a href="{{ route('register') }}" class="btn btn-info w-100">Register</a>
            </div>
        </div>
    </div>
@stop
