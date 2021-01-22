@extends('layouts.head')

@section('pageTitle', 'Login')

    <div class="d-flex justify-content-center align-items-center login-container">
        <div data-aos="zoom-in">
            <form method="POST" class="login-form text-center" action="{{ route('login') }}">
                @csrf

                <img class="logo-img-login mb-3" src="{{ asset('img/logo.png') }}">
                <h1 class="title-login mb-5 font-weight-bold text-uppercase">Smart<br>Presence</h1>

                <div class="form-group">
                    <div class="input-group">
                        <input id="username" type="text"
                            class="form-control form-control-lg @error('username') is-invalid @enderror" name="username"
                            value="{{ old('username') }}" placeholder="NRP/NIM" required autocomplete="username" autofocus>
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-right" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                            </span>
                        </div>
                        @error('username')
                            <span class="invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input id="password" type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" required autocomplete="current-password">
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-right" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-lock-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
                                    <path fill-rule="evenodd"
                                        d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                                </svg>
                            </span>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                </div>

                @error('username')
                    <p class="font-weight-bold text-danger">Incorrect Username or Password!</p>
                @enderror

                <div class="form-check text-left">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }} onclick="changeColor()">
                    <label class="form-check-label" for="remember" style="color: white">Remember Me</label>
                </div>

                <button type="submit" class="btn mt-2 btn-lg btn-login btn-block text-uppercase">
                    {{ __('Login') }}
                </button>

                <p class="copyright-login text-white mt-4">Copyright 2020 © SmartPresence Project</p>
            </form>
        </div>
    </div>
