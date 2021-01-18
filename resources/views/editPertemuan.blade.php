@extends('layouts.app')

@section('pageTitle', 'Edit Pertemuan')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center">
        <h1 class="display-4" style="font-weight: bolder">{{ $class->name }}</h1>
        <h3 class="mt-3">Edit Pertemuan</h3>
    </div>

    <div class="container">
        <form method="POST" action="/class/{{ $class->id }}/{{ $pertemuan->id }}/editPertemuan/success">
            @csrf
            <div class="row justify-content-center">
                
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="pertemuanname">Pertemuan Name</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="pertemuanname" type="text" class="form-control" name="pertemuanname"
                        value="{{ $pertemuan->name }}" required autocomplete="pertemuanname" autofocus>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="timestart">Time Start</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="timestart" type="datetime-local" class="form-control" name="timestart"
                        value="{{ $pertemuan->date_start }}" required autocomplete="timestart" autofocus>
                </div>

                <div class="col-lg-4 mb-4">
                    <label class="col-form-label font-weight-bold" for="timeend">Time End</label> 
                </div>
                <div class="col-lg-5 mb-4">
                    <input id="timeend" type="datetime-local" class="form-control" name="timeend"
                        value="{{ $pertemuan->date_end }}" required autocomplete="timeend" autofocus>
                </div>

                <button class="col-lg-4 btn btn-success mx-1" type="submit">Edit Pertemuan</button>
                <a class="col-lg-4 btn btn-danger mx-1" href="/class/{{ $class->id }}">
                    Cancel
                </a>
            </div>
        </form>
    </div>

@endsection
