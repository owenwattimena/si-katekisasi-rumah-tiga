@extends('web.templates.index')

@section('content')

<div class="container my-5">
    <div class="row">

        <h3 class="">Pengumuman</h3>
        <p class="">Katekisan yang akan di tegukan</p>
        @foreach ($katekisan as $item)
        @php
        @endphp
        <div class="col-md-3">
            <div class="card mb-3 rounded-0 shadow-sm" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset($item->pas_foto) }}" class="img-fluid rounded-0" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_lengkap }}</h5>
                            <p class="card-text mb-1" style="font-size: 9pt">{{ $item->tempat_lahir }}, {{ tanggal_indo($item->tanggal_lahir) }}</p>
                            <p class="card-text" style="font-size: 9pt">{{ $item->jenis_kelamin }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('script')
@endsection
