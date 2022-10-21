@extends('web.templates.index')

@section('content')

<div class="container my-5">
    <div class="row">

        <h3 class="mb-5">TES</h3>
        @forelse ($test as $item)
        @php
        $date = date("Y-m-d");
        @endphp
        <div class="col-md-3">
            <div class="card rounded-0">
                <img src="https://media.istockphoto.com/photos/bible-and-colorful-note-pads-with-question-marks-picture-id1014729456?k=20&m=1014729456&s=612x612&w=0&h=NuMttIf4pIdEw-JbzgxvZFrs6Pv5BXayY7iA647-adA=" alt="...">
                <div class="card-body">
                    {{-- <small class="" style="font-size: 8pt">TANGGAL</small> --}}
                    <h5 class="card-title mb-0">{{ tanggal_indonesia($item->tanggal) }}</h5>
                    <small> Mulai : <b> {{ $item->jam_mulai }} </b> </small>
                    <small>Selesai : <b> {{ $item->jam_selesai }} </b> </small>
                    <hr class="m-0 my-1">
                    <p class="card-text mb-0"><i>{{ $item->judul }}</i></p>
                    <p class="card-text"><i>{{ $item->keterangan }}</i></p>

                    {{-- @if(count($item->absensi) < 1)
                        <a href="{{ $date == $item->tanggal ? route('jadwal.show', $item->id) : '#' }}" class="btn rounded-0 w-100 btn-primary {{ $date != $item->tanggal ? 'disabled' : '' }}">ABSEN</a>
                    @else
                    <button class="btn rounded-0 w-100 btn-success disabled">SUDAH ABSEN</butt>
                        @endif --}}
                        {{-- @if (count($item->jawaban) <= 0)

                        <a href="{{ asset($item->soal) }}" target="_blank" class="btn rounded-0 w-100 btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                            </svg>
                            <span>
                                UNDUH SOAL
                            </span>
                        </a>
                        <button class="btn btn-primary rounded-0 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                            UNGGAH JAWABAN
                        </button>
                        <div class="collapse pt-1" id="collapse{{ $item->id }}">
                            <form action="{{ route('tes.post', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" class="form-control mb-1 form-control-sm rounded-0" name="jawaban" required>
                                <div class="float-end">
                                    <button type="submit" class="btn btn-sm btn-danger rounded-0">
                                        SUBMIT
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        @else --}}
                        {{-- <button class="btn btn-success rounded-0 w-100 disabled" type="button" >
                            SUDAH UNGGAH
                        </button> --}}
                        {{-- <form action="" method="post">
                            @csrf --}}
                            <a href="{{ route('tes.mulai', $item->id) }}" class="btn btn-success rounded-0 w-100" type="submit" >
                                MULAI TES
                            </a>
                        {{-- </form> --}}
                        {{-- @endif --}}

                </div>
            </div>
        </div>
        @empty
        <p class="mb-5 pb-5">Tidak ada tes.</p>
        @endforelse
    </div>
</div>

@endsection

@section('script')
@endsection
