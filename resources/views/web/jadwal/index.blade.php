@extends('web.templates.index')

@section('content')

<div class="container my-5">
    <div class="row">

        <h3 class="mb-5">JADWAL</h3>
        @foreach ($jadwal as $item)
        @php
        $date = date("Y-m-d");
        @endphp
        <div class="col-md-3">
            <div class="card rounded-0">
                <img src="https://images.unsplash.com/photo-1510590337019-5ef8d3d32116?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="card-img-top rounded-0" alt="...">
                <div class="card-body">
                    {{-- <small class="" style="font-size: 8pt">TANGGAL</small> --}}
                    <h5 class="card-title mb-0">{{ tanggal_indonesia($item->tanggal) }}</h5>
                    <small>{{ $item->jam }}</small>
                    <p class="card-text mb-0"><i>{{ $item->pengajar->name }}</i></p>
                    <p class="card-text"><i>{{ $item->tempat }}</i></p>
                    
                    @if(count($item->absensi) < 1)
                        <a href="{{ $date == $item->tanggal ? route('jadwal.show', $item->id) : '#' }}" class="btn rounded-0 w-100 btn-primary {{ $date != $item->tanggal ? 'disabled' : '' }}">ABSEN</a>
                    @else
                        <button class="btn rounded-0 w-100 btn-success disabled">SUDAH ABSEN</butt>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('script')
@endsection
