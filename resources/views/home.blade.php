@extends('layouts.app')

@section('pageTitle', 'Classes')

@section('content')
    <div class="jumbotron jumbotron-fluid text-center">
        <h1 class="display-4" style="font-weight: bolder">CLASSES</h1>
    </div>
    <div class="container">

        @foreach ($classes as $class)
            <div class="form-row my-2">
                @if (Auth::user()->role == 'mahasiswa')
                    <div class="col-md-12">
                        <a class="btn btn-block btn-primary" href="/class/{{ $class->class->id }}">{{ $class->class->name }}</a>
                    </div>
                @endif

                @if (Auth::user()->role == 'dosen')
                    <div class="col-md-11">
                        <a class="btn btn-block btn-primary" href="/class/{{ $class->class->id }}">{{ $class->class->name }}</a>
                    </div>
                    <div class="col-md-1">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#exampleModal">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                            </svg>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <a class="btn btn-danger" href="">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection
