@extends('layouts.app')

@section('pageTitle', $class->name)


@section('content')
    @if ($class->image == 'empty')
        <div class="jumbotron jumbotron-cls jumbotron-fluid text-center background-image mt-4"
            style="background-image:url({{ asset('img/class_default.png') }})">
        @else
            <div class="jumbotron jumbotron-cls jumbotron-fluid text-center background-image mt-4"
                style="background-image:url({{ asset("img/class_image/$class->image") }})">
    @endif
    <h1 class="display-4 title-mobile" style="font-weight: bolder">{{ $class->name }}</h1>
    <div class="mt-4">
        <h4 class="desc-mobile">Dengan {{ $class->dosen->name }},</h4>
        <h5 class="desc-mobile">{{ $class->timedesc }} ({{ $class->location }})</h5>
    </div>
    @if (Auth::user()->role == 'dosen')
        <a href="/class/{{ $class->id }}/editClass">
            <button class="btn btn-outline-light mt-4" type="submit">Edit Kelas</button>
        </a>
    @endif
    @if (Auth::user()->role == 'mahasiswa')
        <button type="button" class="btn btn-outline-light mt-4" data-toggle="modal" data-target="#unenroll">
            Unenroll
        </button>
        <!-- Modal -->
        <div class="modal fade" id="unenroll" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title text-dark">Are you sure you want to unenroll from<br>
                            {{ $class->name }} class?
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <a class="btn btn-danger" href="/class/{{ $class->id }}/unenroll">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>

    <?php
    use Carbon\Carbon;

    $currentdate = Carbon::now('Asia/Jakarta');
    ?>


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
                                <div class="col-lg-4 text-center">
                                    <p class="font-weight-bold">QR Code</p>
                                    <img class="img-fluid"
                                        src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=smartpresenceupnvj.my.id/class/{{ $class->id }}"
                                        alt="qrcode_pertemuan">
                                </div>
                                <div class="col-lg-8">
                                    <p class="font-weight-bold text-center">Daftar Absensi</p>
                                    <table class="table table-hover table-sm table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Nama Mahasiswa</th>
                                                <th scope="col">NIM</th>
                                                <th scope="col">Waktu Kehadiran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absens as $abs)
                                                <tr>
                                                    @if ($pert->id == $abs['pertemuan_id'])
                                                        <td>
                                                            @if ($abs['ava'] == 'empty')
                                                                <img class="shadow-sm"
                                                                    src="{{ asset('img/avatar_default.png') }}" width="32"
                                                                    height="32" style="border-radius: 100%;">
                                                            @else
                                                                <?php $ava = $abs['ava']; ?>
                                                                <img class="shadow-sm" src="{{ asset("img/avatar/$ava") }}"
                                                                    width="32" height="32" style="border-radius: 100%;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $abs['nama'] }}</td>
                                                        <td>{{ $abs['nim'] }}</td>
                                                        <td>{{ $abs['waktu'] }}</td>
                                                        @if (Auth::user()->role == 'dosen')
                                                            <td scope="col">
                                                                <a href="/class/{{ $class->id }}/{{ $pert->id }}/{{ $abs['id'] }}/delete"
                                                                    class="btn btn-danger">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            @if (Auth::user()->role == 'mahasiswa')
                                @foreach ($statuses as $stat)
                                    @if ($stat['pertemuan_id'] == $pert->id)
                                        @if ($stat['status'] == '1')
                                            <p class="text-center text-success font-weight-bold">You already checked in.</p>
                                        @else
                                            @if ($currentdate >= $pert->date_start && $currentdate <= $pert->date_end)
                                                <form action="/class/{{ $class->id }}/{{ $pert->id }}/checked"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-block mt-3">
                                                        Check In
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-check-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                @if ($currentdate > $pert->date_end)
                                                    <p class="text-center text-danger font-weight-bold">Class has ended.</p>
                                                @endif
                                                @if ($currentdate < $pert->date_start)
                                                    <p class="text-center text-info font-weight-bold">Class has not started
                                                        yet.</p>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @endif

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
