@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('body')
<section class="content-header">
    <h1>
        Tes
        <small>Data Detail Jawban</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-list"></i> Tes</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Tes</h3>
        </div>
        <div class="box-body">

            <p>Nama Lengkap : {{ $test->jawaban[0]->katekisan->nama_lengkap }}</p>
            <p>Tes : {{ $test->judul }}</p>
            <p>Keterangan : {{ $test->keterangan }}</p>
            @php
            $sum = 0;
            if (count($test->jawaban->first()->detailJawabanBerganda) > 0){

                $sum = $test->jawaban->first()->detailJawabanBerganda->sum(function($val){
                    return $val->pilihanJawaban->jawaban;
                });
            }
            else{

                $sum = $test->jawaban->first()->detailJawabanEssay->sum(function($val){
                    return $val->benar;
                });
            }

            @endphp
            <p>NILAI : {{ (  ($sum*10) / (count($test->soal)*10)  )*100 }}</p>
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Soal</th>
                        @if (count($test->jawaban->first()->detailJawabanBerganda) > 0)
                        <th>Jawban Benar</th>
                        @endif
                        <th>Jawaban</th>
                        <th>Point</th>
                        <th>Jam</th>
                        @if (count($test->jawaban->first()->detailJawabanEssay) > 0)
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @if (count($test->jawaban->first()->detailJawabanBerganda) > 0)
                    @foreach ($test->jawaban->first()->detailJawabanBerganda as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>
                            {!! $item->pilihanJawaban->soal->soal !!}
                        </td>
                        <td>
                            {{ $item->pilihanJawaban->soal->jawaban->pilihan }}
                        </td>
                        <td>
                            {{ $item->pilihanJawaban->pilihan }}
                        </td>
                        <td>
                            @if ($item->pilihanJawaban->soal->jawaban->pilihan == $item->pilihanJawaban->pilihan)
                            {{ 10 }}
                            @else
                            {{ 0 }}
                            @endif
                        </td>
                        <td>
                            {{ $item->updated_at }}
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @foreach ($test->jawaban->first()->detailJawabanEssay as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>
                            {!! $item->soal->soal !!}
                        </td>
                        <td>
                            {{ $item->jawaban }}
                        </td>
                        {{-- <td>
                            {{ $item->pilihanJawaban->pilihan }}
                        </td> --}}
                        <td>
                            @if ($item->benar != null || $item->benar == true)
                            {{ 10 }}
                            @else
                            {{ 0 }}
                            @endif
                        </td>
                        <td>
                            {{ $item->updated_at }}
                        </td>
                        @if (count($test->jawaban->first()->detailJawabanEssay) > 0)
                        <td>
                            <a href="{{ route('admin.test.essay.nilai', [$item->id,'nilai'=>'benar']) }}" class="btn bg-green btn-xs">BENAR</a>
                            <a href="{{ route('admin.test.essay.nilai', [$item->id,'nilai'=>'salah']) }}" class="btn bg-maroon btn-xs">SALAH</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nomor</th>
                        <th>Soal</th>
                        @if (count($test->jawaban->first()->detailJawabanBerganda) > 0)
                        <th>Jawban Benar</th>
                        @endif
                        <th>Jawaban</th>
                        <th>Point</th>
                        <th>Jam</th>
                        @if (count($test->jawaban->first()->detailJawabanEssay) > 0)
                        <th></th>
                        @endif
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
