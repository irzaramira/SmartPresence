@extends('layouts.app')

@section('pageTitle', $class->name)


@section('content')
    @if ($class->image == 'empty')
        <div class="jumbotron jumbotron-cls jumbotron-fluid text-center background-image mt-2"
            style="background-image:url({{ asset('img/class_default.png') }})">
        @else
            <div class="jumbotron jumbotron-cls jumbotron-fluid text-center background-image mt-2"
                style="background-image:url({{ asset("img/class_image/$class->image") }})">
    @endif
    <h1 class="display-4" style="font-weight: bolder">{{ $class->name }}</h1>
    <h4 class="mt-5">Dengan {{ $class->dosen->name }},</h4>
    <h5>{{ $class->timedesc }} ({{ $class->location }})</h5>
    @if (Auth::user()->role == 'dosen')
        <a href="/class/{{ $class->id }}/editClass">
            <button class="btn btn-outline-light mt-4" type="submit">Edit Kelas</button>
        </a>
    @endif
    </div>

    <div class="container">
        <div class="accordion" id="accordionExample">
            @foreach ($pertemuan as $index => $pert)
                <div class="card">
                    <div class="card-header" type="button" id="headingOne" data-toggle="collapse"
                        data-target="#collapse{{ $pert->id }}" aria-expanded="false" aria-controls="collapseOne">
                        <div class="row">
                            <div class="col-sm-6 font-weight-bold">
                                <p>{{ $pert->name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-right">{{ $pert->date_start }} - {{ $pert->date_end }}</p>
                            </div>
                        </div>
                    </div>

                    <div id="collapse{{ $pert->id }}" class="collapse" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <p class="font-weight-bold">QR Code</p>
                                    <img class="img-fluid" src="{{ asset('img/elearning_qr.png') }}" alt="qrcode">
                                </div>
                                <div class="col-8">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Mahasiswa</th>
                                                <th scope="col">NIM</th>
                                                <th scope="col">Waktu Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absens as $abs)
                                                <tr>
                                                    @if ($pert->id == $abs['pertemuan_id'])
                                                        <td>{{ $abs['nama'] }}</td>
                                                        <td>{{ $abs['nim'] }}</td>
                                                        <td>{{ $abs['waktu'] }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if (Auth::user()->role == 'dosen')
                                <div class="btn-group col-lg-12 mt-3">
                                    <a href="/class/{{ $class->id }}/{{ $pert->id }}/editPertemuan" class="btn btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{ $pert->id }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $pert->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure you want to delete<br>
                                                    {{ $pert->name }}?
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <a class="btn btn-danger"
                                                    href="/class/{{ $class->id }}/{{ $pert->id }}/deletePertemuan">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if (Auth::user()->role == 'dosen')
        <div class="justify-content-center text-center">
            <a href="/class/{{ $class->id }}/addPertemuan">
                <button class="btn btn-success mt-4" type="submit">Add Pertemuan</button>
            </a>
        </div>
    @endif
    </div>

@endsection
