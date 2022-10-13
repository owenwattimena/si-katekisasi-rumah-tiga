@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('body')
<section class="content-header">
    <h1>
        Tes
        <small>Data Tes Katekisasi</small>
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
            <button class="btn btn-flat bg-olive" style="margin-bottom: 15px" data-toggle="modal" data-target="#modal-default">TAMBAH</button>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.test.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Tes</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tanggal">Periode</label>
                                    <input type="hidden" name="id_periode" value="{{ $periode->id }}">
                                    <input type="text" class="form-control" id="tanggal" value="{{ old('periode', ($periode ? $periode->periode : '')) }}" readonly>
                                    @error('tanggal')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', '') }}" required>
                                    @error('tanggal')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jam_mulai">Jam Mulai</label>
                                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', '') }}" required>
                                            @error('jam_mulai')
                                            <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jam_selesai">Jam Selesai</label>
                                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', '') }}" required>
                                            @error('jam_selesai')
                                            <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', '') }}" required placeholder="Masukan Judul">
                                    @error('judul')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', '') }}" required placeholder="Masukan keterangan">
                                    @error('keterangan')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="soal">Soal</label>
                                    <input type="file" class="form-control" id="soal" name="soal" value="{{ old('soal', '') }}" required>
                                    @error('soal')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Soal</th>
                        <th>Tanggal Tes</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($test as $item)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td> <a href="{{ asset($item->soal) }}" target="_blank" rel="noopener noreferrer">link soal</a> </td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_selesai }}</td>
                        <td>
                            <a href="{{ route('admin.test.jawaban', $item->id) }}" class="btn btn-xs bg-olive btn-flat">JAWABAN</a>
                            <a href="" class="btn btn-xs bg-maroon btn-flat">HAPUS</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Soal</th>
                        <th>Tanggal Tes</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
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
