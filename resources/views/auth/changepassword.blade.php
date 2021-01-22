@extends('layouts.app')

@section('pageTitle', 'Change Password')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center">
        <h1 class="display-4" style="font-weight: bolder">Change Password</h1>
        @if (Auth::user()->image == 'empty')
            <div class="text-center my-5">
                <img class="shadow-sm" src="{{ asset('img/avatar_default.png') }}" width="200" height="200"
                    style="border-radius: 100%;">
            </div>
        @else
            <?php $image = $user->image; ?>
            <div class="text-center my-5">
                <img class="shadow-sm" src="{{ asset("img/avatar/$image") }}" width="200" height="200"
                    style="border-radius: 100%;">
            </div>
        @endif
        <h3>{{ $user->name }}</h3>
    </div>

    <div class="container">
        <p class="text-center text-danger mb-3" style="font-weight: bold">{{ $error }}</p>
        <form method="POST" action="/changePassword/success">
            @csrf

            <div class="row justify-content-center">
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="currentpass">Current Password</label>
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="currentpass" type="password" class="form-control" name="currentpass" value="" required
                        autocomplete="currentpass" placeholder="" autofocus>
                </div>

                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="new_password">New Password</label>
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="new_password" type="password" class="form-control" name="new_password" value="" required
                        autocomplete="new_password" placeholder="" autofocus>
                </div>

                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="confirm_password">Confirm New Password</label>
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="confirm_password" type="password"
                        class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" value=""
                        required autocomplete="confirm_password" placeholder="" autofocus>
                    @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="col-lg-4 btn btn-success mx-1" type="submit">Confirm</button>
                <a class="col-lg-4 btn btn-danger mx-1" href="/">
                    Cancel
                </a>

            </div>
        </form>
    </div>

@endsection
