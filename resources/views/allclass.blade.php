@extends('layouts.app')

@section('pageTitle', 'All Class')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center mt-4">
        <h1 class="display-4" style="font-weight: bolder">ALL CLASS</h1>
        <h3>Available</h3>
    </div>
    <div class="container">

        <form action="/allclass/search" method="GET">
            @csrf
            <div class="d-flex justify-content-center">
                <div class="input-group mb-3 col-md-6">
                    <input type="search" class="form-control" placeholder="Search Class..." name="search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <p class="text-center text-info mb-3" style="font-weight: bold">{{ $message }}</p>

        <div data-aos="fade-up" class="form-row">
            @foreach ($classes as $class)
                <div class="col-lg-4 my-2">
                    <div class="border shadow-sm rounded">
                        <div class="text-decoration-none text-dark">
                            @if ($class->image == 'empty')
                                <div class="w-100 rounded-top"
                                    style="height: 10rem; background-image:url({{ asset('img/class_default.png') }}); background-size:cover">
                                </div>
                            @else
                                <?php $image = $class->image; ?>
                                <div class="w-100 rounded-top"
                                    style="height: 10rem; background-image:url({{ asset("img/class_image/$image") }}); background-size:cover">
                                </div>
                            @endif
                            <div class="w-100 p-3" style="min-height: 10rem">
                                <h5 class="card-title">{{ $class->name }}</h5>
                                <p class="card-text">{{ $class->timedesc }} ({{ $class->location }})</p>
                                <p class="card-text">Dengan {{ $class->dosen->name }}</p>
                            </div>

                            @if (Auth::user()->role == 'mahasiswa')
                                @foreach ($statuses as $status)
                                    @if ($status['classes_id'] == $class->id)
                                        @if ($status['status'] == '1')
                                            <p class="text-center text-danger font-weight-bold">You already in this class.
                                            </p>
                                        @else
                                            <form action="/{{ $class->id }}/enroll" method="POST">
                                                @csrf
                                                <button class="btn btn-success btn-block" type="submit">Enroll</button>
                                            </form>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </div>
@endsection
