@extends('layouts.app')

@section('pageTitle', 'Edit Profile')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center">
        <h1 class="display-4" style="font-weight: bolder">Edit Profile</h1>
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
    </div>

    <div class="container">
        <form method="POST" action="/editProfile/success" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center">
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="name">Name</label>
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required
                        autocomplete="name" placeholder="Name" autofocus>
                </div>

                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="timedescclass">Email</label>
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required
                        autocomplete="email" placeholder="Email" autofocus>
                </div>
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="name">Avatar</label>
                </div>
                <div class="col-lg-5 mb-4">
                    <input type="file" class="form-control-file" name="image">
                </div>


                <button class="col-lg-4 btn btn-success mx-1" type="submit">Update</button>
                <a class="col-lg-4 btn btn-danger mx-1" href="/">
                    Cancel
                </a>

            </div>
        </form>
    </div>

@endsection
