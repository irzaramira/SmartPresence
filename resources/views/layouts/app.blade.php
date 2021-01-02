<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@extends('layouts.head')

<body onload="realtimejam()">
    <div id="app">
        @guest
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
                <div class="container">
                    <img class="logo-img-nav mr-3" src="{{ asset('img/logo.png') }}">
                    <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold">
                        Smart Presence - Guest
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @else
            @if (Auth::user()->role == 'mahasiswa')

                <nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top">
                    <div class="container">
                        <a class="navbar-brand "href="{{ url('/') }}">
                            <img class="logo-img-nav" src="{{ asset('img/logo.png') }}">
                        </a>
                        <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold">
                            Smart Presence | Mahasiswa
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

            @endif

            @if (Auth::user()->role == 'dosen')

                <nav class="navbar navbar-expand-md navbar-dark shadow-sm fixed-top">
                    <div class="container">
                        <a class="navbar-brand "href="{{ url('/') }}">
                            <img class="logo-img-nav" src="{{ asset('img/logo.png') }}">
                        </a>
                        <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold">
                            Smart Presence | Dosen
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

                            </ul>

                            <!-- Right Side Of Navbar -->

                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @if (Auth::user()->role == 'dosen')
                                            <a class="dropdown-item" href="/addClass">Add Kelas</a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

            @endif

        @endguest

        <main class="content py-5">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="page-footer font-small pt-4">
            <div class="container">
                <!-- Footer Text -->
                <div class="container-fluid text-center text-md-left">

                    <!-- Grid row -->
                    <div class="row">

                        <!-- Grid column -->
                        <div class="col-md-6 mt-md-0 mt-5 text-center">
                            <!-- Content -->
                            <h4 class="text-uppercase font-weight-bold mb-4">WAKTU SERVER</h5>
                                <p class="" id="tanggal"></p>
                                <p id="jam" style="font-size:2rem"></p>
                        </div>
                        <!-- Grid column -->

                        <hr class="clearfix w-100 d-md-none pb-3">

                        <!-- Grid column -->
                        <div class="col-md-6 mb-md-0 mb-3 text-center">

                            @if (Auth::user()->role == 'dosen')
                                <!-- Content -->
                                <h5 class="text-uppercase font-weight-bold">WEBSITE UPNVJ DOSEN</h5>
                                <a class="btn btn-outline-light mx-1 t-1 b-1" href="https://dosen.upnvj.ac.id/"
                                    target="blank">
                                    DOSEN UPNVJ
                                </a>
                                <a class="btn btn-outline-light mx-1 t-1 b-1" href="https://elearning40.upnvj.ac.id/"
                                    target="blank">
                                    ELEARNING 4.0
                                </a>
                            @endif

                            @if (Auth::user()->role == 'mahasiswa')
                                <!-- Content -->
                                <h5 class="text-uppercase font-weight-bold">WEBSITE UPNVJ MAHASISWA</h5>
                                <a class="btn btn-outline-light mx-1 t-1 b-1" href="https://akademik.upnvj.ac.id/"
                                    target="blank">
                                    DOSEN UPNVJ
                                </a>
                                <a class="btn btn-outline-light mx-1 t-1 b-1" href="https://elearning40.upnvj.ac.id/"
                                    target="blank">
                                    ELEARNING 4.0
                                </a>
                            @endif


                        </div>
                        <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                </div>
            </div>
            
            <!-- Footer Text -->

            <!-- Copyright -->
            <div class="footer-copyright text-center py-4">
                <a href="https://fik.upnvj.ac.id/" target="blank" style="text-decoration: none; color:white ">
                    Copyright © Fakultas Ilmu Komputer UPN Veteran Jakarta 2020
                </a>
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </div>
</body>

</html>
