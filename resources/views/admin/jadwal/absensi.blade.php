@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endsection

@section('body')
<section class="content-header">
    <h1>
        Daftar Hadir
        <small>Data Daftar Hadir</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Daftar Hadir</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Hadir - {{ $jadwal->tanggal }} - {{ $jadwal->tempat }}</h3>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 30px;">#</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Absen</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($absensi as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $item->katekisan->nama_lengkap }}</td>
                        <td>{{ $item->tanggal_absen }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Absen</th>
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
