@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endsection

@section('body')
<section class="content-header">
    <h1>
        Jawaban
        <small>Data Daftar Jawaban</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Daftar Jawaban</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Jawaban - {{ $jawaban->judul }} - {{ $jawaban->tanggal }}</h3>
        </div>
        <div class="box-body">
            <a href="{{ route('admin.test.jawaban.download', $jawaban->id) }}" target="_blank" class="btn bg-maroon btn-xs" style="margin-bottom: 15px;">UNDUH</a>
            <p>Total Soal : {{ count($jawaban->soal) }}</p>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Nama Lengkap</th>
                        <th>Soal di Jawab</th>
                        <th>Soal Benar</th>
                        <th>Nilai</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @foreach ($jawaban->jawaban as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $item->katekisan->nama_lengkap }}</td>
                        <td>{{ (count($item->detailJawabanBerganda) > 0) ? count($item->detailJawabanBerganda) : count($item->detailJawabanEssay) }}</td>
                        <td>
                            @if (count($item->detailJawabanBerganda) > 0)
                            @php
                            $sum = 0;
                            $sum = $item->detailJawabanBerganda->sum(function($val){
                                return $val->pilihanJawaban->jawaban;
                            });
                            @endphp
                            {{ $sum }}
                            @else
                            @php
                            $sum = $item->detailJawabanEssay->sum(function($val){
                                return $val->benar;
                            });
                            @endphp
                            {{ $sum }}
                            @endif
                        </td>
                        <td>
                            {{ (  ($sum*10) / (count($jawaban->soal)*10)  )*100 }}
                        </td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.test.jawaban.detail', [$jawaban->id, $item->id]) }}" class="btn bg-green btn-sm">DETAIL</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Nama Lengkap</th>
                        <th>Soal di Jawab</th>
                        <th>Soal Benar</th>
                        <th>Nilai</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
@endsection


@section('script')
<script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true
            , 'lengthChange': false
            , 'searching': false
            , 'ordering': true
            , 'info': true
            , 'autoWidth': false
        })

    })

</script>
@endsection
