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
    <div class="row">

        <div class="col-md-2">

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Status</h3>
                </div>
                <div class="box-body box-profile">
                    <a href="{{ route('admin.katekisan.status', [$katekisan->id, 1]) }}" class="btn btn-block bg-olive btn-flat"><b>TERIMA</b></a>
                    <a href="{{ route('admin.katekisan.status', [$katekisan->id, 2]) }}" class="btn btn-block btn-danger btn-flat"><b>TOLAK</b></a>
                    <a href="{{ route('admin.katekisan.status', [$katekisan->id, 3]) }}" class="btn btn-block btn-primary btn-flat"><b>LULUS</b></a>
                    <a href="{{ route('admin.katekisan.status', [$katekisan->id, 4]) }}" class="btn btn-block bg-black btn-flat"><b>TIDAK LULUS</b></a>
                    <a href="{{ route('admin.katekisan.status', [$katekisan->id, 5]) }}" class="btn btn-block btn-warning btn-flat"><b>NONAKTIFKAN</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Katekisan</h3>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset($katekisan->pas_foto) }}" style="height: 150px; width: 150px" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $katekisan->nama_lengkap }} - {{ $katekisan->nama_panggilan }}</h3>
                    <p class="text-muted text-center">{{ $katekisan->status }}</p>
                    <div class="text-center">    
                        <span class="badge {{ Config::get('app.status_katekumen_badge', 'default')[$katekisan->status_katekumen]; }}">{{ Config::get('app.status_katekumen', 'default')[$katekisan->status_katekumen]; }}</span>
                    </div>
                    <br>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>NIK</b> <span class="pull-right">{{ $katekisan->nik }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Tempat, Tanggal lahir</b> <span class="pull-right">{{ $katekisan->tempat_lahir }}, {{ $katekisan->tanggal_lahir }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <span class="pull-right">{{ $katekisan->jenis_kelamin }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Anak Ke-</b> <span class="pull-right">{{ $katekisan->anak_ke }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Unit</b> <span class="pull-right">{{ $katekisan->unit }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Sektor</b> <span class="pull-right">{{ $katekisan->sektor }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Tahun Baptis</b> <span class="pull-right">{{ $katekisan->tahun_baptis }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Pendidikan</b> <span class="pull-right">{{ $katekisan->pendidikan }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <span class="pull-right">{{ $katekisan->status }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Telp/HP</b> <span class="pull-right">{{ $katekisan->telp_hp }}</span>
                        </li>
                        <h5>Orang Tua</h5>
                        <li class="list-group-item">
                            <b>Nama Ayah</b> <span class="pull-right">{{ $katekisan->nama_ayah }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Pekerjaan Ayah</b> <span class="pull-right">{{ $katekisan->pekerjaan_ayah }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Unit Ayah</b> <span class="pull-right">{{ $katekisan->unit_ayah }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Sektor Ayah</b> <span class="pull-right">{{ $katekisan->sektor_ayah }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Nama Ibu</b> <span class="pull-right">{{ $katekisan->nama_ibu }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Pekerjaan Ibu</b> <span class="pull-right">{{ $katekisan->pekerjaan_ibu }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Unit Ibu</b> <span class="pull-right">{{ $katekisan->unit_ibu }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Sektor Ibu</b> <span class="pull-right">{{ $katekisan->sektor_ibu }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Nama Wali</b> <span class="pull-right">{{ $katekisan->nama_wali }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Pekerjaan Wali</b> <span class="pull-right">{{ $katekisan->pekerjaan_wali }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Unit Wali</b> <span class="pull-right">{{ $katekisan->unit_wali }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Sektor Wali</b> <span class="pull-right">{{ $katekisan->sektor_wali }}</span>
                        </li>
                    </ul>

                </div>
            </div>
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
