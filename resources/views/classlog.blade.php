@extends('layouts.app')

@section('pageTitle', 'Registered Class')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center mt-4">
        <h1 class="display-4" style="font-weight: bolder">Registered Class</h1>
    </div>
    <div class="container">

        @foreach ($users as $user)
            <div class="my-5">
                <h3 class="font-weight-bold">Dosen : {{ $user->name }}</h3>
                <table class="table table-hover">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Class Name</th>
                            <th>Time Description</th>
                            <th>Location</th>
                            <th>Created At</th>
                            <th>Last Update</th>
                            <th>Pertemuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($classes as $class)
                            @if ($class['dosen_id'] == $user->id)
                                <?php $no += 1; ?>
                                <tr>

                                    <td class="text-center">{{ $no }}</td>
                                    <td>{{ $class['name'] }}</td>
                                    <td>{{ $class['timedesc'] }}</td>
                                    <td>{{ $class['location'] }}</td>
                                    <td>
                                        @if ($class['created_at'] == null)
                                            -
                                        @else
                                            {{ $class['created_at'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($class['updated_at'] == null)
                                            -
                                        @else
                                            {{ $class['updated_at'] }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/classregistered/{{ $user->id }}/{{ $class['id'] }}/pertemuanregistered/"
                                            class="btn btn-block btn-success">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

    </div>
@endsection
