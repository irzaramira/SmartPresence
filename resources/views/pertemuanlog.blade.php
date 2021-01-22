@extends('layouts.app')

@section('pageTitle', 'Registered Pertemuan')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center mt-4">
        <h1 class="display-4" style="font-weight: bolder">Registered Pertemuan</h1>
        <h3>{{ $class->name }} dengan {{ $dosen->name }}</h3>
        <a href="{{ url('/classregistered')}}" class="btn btn-danger mt-4">
            Back
        </a>
    </div>
    <div class="container">

        @foreach ($pertemuan as $pert)
            <div class="my-5">
                <h3 class="font-weight-bold">{{ $pert->name }}</h3>
                <div class="row">
                    <div class="col-lg-2">
                        <h5>Created at </h5>
                    </div>
                    <div class="col-lg-10">
                        @if ($pert->created_at == null)
                            <h5>: -</h5>
                        @else
                            <h5>: {{ $pert->created_at }}</h5>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <h5>Last Update </h5>
                    </div>
                    <div class="col-lg-10">
                        @if ($pert->updated_at == null)
                            <h5>: -</h5>
                        @else
                            <h5>: {{ $pert->updated_at }}</h5>
                        @endif
                    </div>
                </div>

                <table class="table table-hover table-responsive-sm">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th>NIM</th>
                            <th>Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($absen as $abs)
                            @if ($abs['pertemuanid'] == $pert->id)
                                <?php $no += 1; ?>
                                <tr>
                                    <td class="text-center">{{ $no }}</td>
                                    <td>{{ $abs['nim'] }}</td>
                                    <td>{{ $abs['name'] }}</td>
                                    <td>{{ $abs['date'] }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
        @endforeach

    </div>
@endsection
