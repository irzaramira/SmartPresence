@extends('layouts.app')

@section('pageTitle', 'Home')

@section('content')

    <div class="" style="min-height: 100vh">
        <div class="d-flex align-items-center">
            <div class="w-100">
                <h1 class="text-danger text-center font-weight-bold" style="margin-top: 20rem">You are not allowed to see this page.</h1>
                <p class="text-center font-weight-bold">please return to <a href="{{ url('/') }}">home</a>.</p>
            </div>
        </div>
    </div>

@endsection
