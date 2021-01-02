@extends('layouts.app')

@section('pageTitle', 'Add Kelas')

@section('content')
    <div class="jumbotron jumbotron-fluid text-center">
        <h1 class="display-4" style="font-weight: bolder">Add Kelas</h1>
    </div>

    <div class="container">
        <form method="POST" action="addClass/success">
            @csrf
            <div class="row justify-content-center">
                
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="classname">Class Name</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="classname" type="text" class="form-control" name="classname"
                        value="" required autocomplete="classname" autofocus>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="timedescclass">Time Description</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="timedescclass" type="text" class="form-control" name="timedescclass"
                        value="" required autocomplete="timedescclass" autofocus>
                </div>

                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="location">Location</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="location" type="text" class="form-control" name="location"
                        value="" required autocomplete="timedescclass" autofocus>
                </div>

                <button class="col-lg-4 btn btn-success" type="submit">Add Kelas</button>
                <a class="btn btn-danger mx-2" href="/">
                    Cancel
                </a>
            </div>
        </form>
    </div>

@endsection
