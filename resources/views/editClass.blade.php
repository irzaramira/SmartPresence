@extends('layouts.app')

@section('pageTitle', 'Add Kelas')

@section('content')
    <div class="jumbotron jumbotron-fluid text-center">
        <h3>Edit Kelas</h3>
        <h1 class="display-4" style="font-weight: bolder">{{ $class->name }}</h1>
    </div>

    <div class="container">
        <form method="POST" action="/class/{{ $class->id }}/editClass/success">
            @csrf
            <div class="row justify-content-center">
                
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="classname">Class Name</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="classname" type="text" class="form-control" name="classname"
                        value="{{ $class->name }}" required autocomplete="classname" autofocus>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="timedescclass">Time Description</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="timedescclass" type="text" class="form-control" name="timedescclass"
                        value="{{ $class->timedesc }}" required autocomplete="timedescclass" autofocus>
                </div>

                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="location">Location</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="location" type="text" class="form-control" name="location"
                        value="{{ $class->location }}" required autocomplete="timedescclass" autofocus>
                </div>

                <button class="col-lg-4 btn btn-success" type="submit">Submit</button>
                <a class="btn btn-danger mx-2" href="/class/{{ $class->id }}">
                    Cancel
                </a>
                
            </div>
        </form>
    </div>

@endsection
