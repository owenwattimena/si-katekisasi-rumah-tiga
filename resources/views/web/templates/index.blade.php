<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Katekisasi GPM Rumah Tiga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @yield('style')
</head>
<body id="body">

    <!-- NAVBAR -->
    <div class="fixed-top">
        <nav class="navbar navbar-expand-lg shadow-sm bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo_si_katekisasi.png') }}" alt="logo" height="64"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                            <a class="nav-link" aria-current="page" href="{{ url('/') }}">Beranda</a>
                        </li>
                        @auth('katekisan')
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('jadwal*')) ? 'active' : '' }}" href="{{ route('jadwal') }}">Jadwal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('tes*')) ? 'active' : '' }}" href="{{ route('tes') }}">Tes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('pengumuman*')) ? 'active' : '' }}" href="{{ route('pengumuman') }}">Pengumuman</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::guard('katekisan')->user()->nama_lengkap}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('keluar') }}">Keluar</a></li>
                            </ul>
                        </li>
                        @endauth

                        @guest('katekisan')
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-primary mb-2" aria-current="page" href="{{ route('masuk') }}">Masuk</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-outline-primary" aria-current="page" href="{{ route('daftar') }}">Daftar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <div class="alert alert-primary rounded-0 fw-light py-1 mb-0" role="alert">
            <marquee behavior="" direction="">A simple primary alert—check it out!</marquee>
        </div> --}}

        @if (session('status'))
        <div class="rounded-0 alert alert-{!! session('status') !!} alert-dismissible fade show" role="alert">
            <div class="container">{!! session('message') !!}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <div style="padding-top: 80px">
        @yield('content')
    </div>


    <footer class="bg-dark text-light py-5">
        <p class="mb-0 text-center">GPM RUMAH TIGA</p>
    </footer>
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    @yield('script')
</body>
</html>
