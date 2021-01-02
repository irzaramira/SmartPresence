@extends('layouts.app')

@section('pageTitle', $class->name)

@section('content')
    <div class="jumbotron jumbotron-fluid text-center">
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
                    <div class="card-header" type="button" id="headingOne" data-toggle="collapse" data-target="#collapse{{ $pert->id }}"
                        aria-expanded="false" aria-controls="collapseOne">
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
