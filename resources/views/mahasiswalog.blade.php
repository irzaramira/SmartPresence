@extends('layouts.app')

@section('pageTitle', 'Registered Mahasiswa')

@section('content')
    <div class="jumbotron jumbotron-og jumbotron-fluid text-center mt-4">
        <h1 class="display-4" style="font-weight: bolder">Registered Mahasiswa</h1>
    </div>
    <div class="container">
        <table class="table table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if ($user->image == 'empty')
                                <img class="shadow-sm" src="{{ asset('img/avatar_default.png') }}" width="32" height="32"
                                    style="border-radius: 100%;">
                            @else
                                <img class="shadow-sm" src="{{ asset("img/avatar/$user->image") }}" width="32" height="32"
                                    style="border-radius: 100%;">
                            @endif
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->created_at == null)
                                -
                            @else
                                {{ $user->created_at }}
                            @endif
                        </td>
                        <td>
                            @if ($user->updated_at == null)
                                -
                            @else
                                {{ $user->updated_at }}
                            @endif
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger rounded-right" data-toggle="modal"
                                data-target="#exampleModal{{ $user->id }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                </svg>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure you want to delete<br>
                                                user {{ $user->username }} ({{ $user->name }})?
                                            </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <a class="btn btn-danger" href="/userregistered/mahasiswa/{{ $user->id }}/delete">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Button trigger modal -->
        <div class="text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adduser">
                Add Mahasiswa
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="adduser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold">Add Mahasiswa</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/userregistered/mahasiswa/add/success" method="POST">
                            @csrf
                            <div>
                                <label class="col-form-label" for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" value="" required
                                    autocomplete="username" autofocus>
                                <label class="col-form-label" for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="" required
                                    autocomplete="name" autofocus>
                                <label class="col-form-label" for="email">Email</label>
                                <input id="email" type="text" class="form-control" name="email" value="" required
                                    autocomplete="email" autofocus>
                                <fieldset disabled>
                                    <label class="col-form-label" for="email">Password</label>
                                    <input id="password" type="text" class="form-control" name="password" value="" required
                                        autocomplete="password" placeholder="**same as username**" autofocus>
                                </fieldset>
                                <div class="text-center">
                                    <button type="reset" class="btn btn-secondary mt-2">Reset</button>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        <button class="btn btn-success" type="submit">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
