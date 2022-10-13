@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('body')
<section class="content-header">
    <h1>
        Periode
        <small>Data Periode Katekisasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Periode</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Periode</h3>
        </div>
        <div class="box-body">
            <button class="btn btn-flat bg-olive" style="margin-bottom: 15px" data-toggle="modal" data-target="#modal-default">TAMBAH</button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.periode.post') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Periode</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="periode">Periode</label>
                                    <input type="text" class="form-control" id="periode" name="periode" value="{{ old('periode', '') }}" required placeholder="Masukan Periode">
                                    @error('periode')
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
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periode as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->periode }}</td>
                        <td> <span class="badge {{ $item->aktif == true ? 'bg-green' : 'bg-black' }}"> {{ $item->aktif == true ? 'Aktif' : 'NONAKTIF' }} </span> </td>
                        <td>
                            <a href="{{ route('admin.periode.status', $item->id) }}" onclick="return confirm('Yakin ingin mengubah status periode?')" class="btn btn-flat bg-navy btn-sm" style="margin-bottom: 15px">UBAH STATUS</a>
                            <button class="btn btn-flat bg-orange btn-sm" style="margin-bottom: 15px" data-toggle="modal" data-target="#modal-{{ $item->id }}">UBAH</button>
                            <a href="{{ route('admin.periode.delete', $item->id) }}" onclick="return confirm('Yakin ingin menghapus periode?')" class="btn btn-flat bg-maroon btn-sm" style="margin-bottom: 15px">HAPUS</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-{{ $item->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.periode.put', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Ubah Periode</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="periode">Periode</label>
                                            <input type="text" class="form-control" id="periode" name="periode" value="{{ old('periode', $item->periode) }}" required placeholder="Masukan Periode">
                                            @error('periode')
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

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Periode</th>
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
