@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('body')
<section class="content-header">
    <h1>
        Katekisan
        <small>Data Peserta Katekisasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Katekisan</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Katekisan Periode {{ $periode }}</h3>
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>JK</th>
                        <th>Unit</th>
                        <th>Sektor</th>
                        <th>Tahun Baptis</th>
                        <th>Pendidikan</th>
                        <th>Telp/HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($katekisan as $item)
                    <tr>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->sektor }}</td>
                        <td>{{ $item->tahun_baptis }}</td>
                        <td>{{ $item->pendidikan }}</td>
                        <td>{{ $item->telp_hp }}</td>
                        <td> <span class="badge {{ Config::get('app.status_katekumen_badge', 'default')[$item->status_katekumen ] }}"> {{ Config::get('app.status_katekumen', 'default')[$item->status_katekumen ] }} </span></td>
                        <td>
                            <a href="{{ route('admin.katekisan.show', $item->id) }}" class="btn btn-xs bg-olive btn-flat">DETAIL</a>
                            <a href="" class="btn btn-xs bg-maroon btn-flat">HAPUS</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>JK</th>
                        <th>Unit</th>
                        <th>Sektor</th>
                        <th>Tahun Baptis</th>
                        <th>Pendidikan</th>
                        <th>Telp/HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
