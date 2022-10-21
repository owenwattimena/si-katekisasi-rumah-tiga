@extends('web.templates.index')

@section('content')

<div class="container my-5">
    <div class="row">

        <h3 class="mb-5">{{ $test->judul }} - {{ $test->keterangan }}</h3>

        <p class="mb-0">Nomor Soal</p>
        <div class="container">
            <div class="row mb-3">
                @foreach ($soal->sortBy('nomor_soal') as $item)
                <div class="col-1 card rounded-0">{{ $item->nomor_soal }}</div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-title pt-4 px-3">
                {!! $soal[0]->soal !!}
            </div>
            <div class="card-body">
                <ul class="list-group rounded-0">
                    @foreach ($soal[0]->pilihan->shuffle() as $item)
                    <ul class="list-group rounded-0">
                        <li class="list-group-item"> <input type="radio" name="jawaban" id="jawaban{{ $item->id }}"> <label for="jawaban{{ $item->id }}">{{ $item->pilihan }}</label> </li>
                        @endforeach
                    </ul>
                    <a class="btn btn-secondary rounded-0" style="display: inline">Soal Sebelumnya</a>
                    <a class="btn btn-success rounded-0" style="display: inline">Soal Selanjutnya</a>
            </div>

        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
