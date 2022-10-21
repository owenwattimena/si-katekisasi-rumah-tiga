@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

@endsection

@section('body')
<section class="content-header">
    <h1>
        Soal
        <small>Soal Tes Katekisasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-list"></i> Tes</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $test->judul }} - {{ $test->keterangan }}</h3>
        </div>
        <div class="box-body">
            <button class="btn btn-flat bg-olive" style="margin-bottom: 15px" data-toggle="modal" data-target="#modal-default">TAMBAH</button>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.test.soal.post', $test->id) }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Tes</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nomor_soal">Nomor Soal</label>
                                    <input type="text" class="form-control" id="nomor_soal" name="nomor_soal" value="{{ old('nomor_soal', '') }}" placeholder="Masukan Nomor Soal" required>
                                    
                                    @error('nomor_soal')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="soal">Soal</label>
                                    <textarea class="form-control textarea" id="soal" name="soal" value="{{ old('soal', '') }}" required></textarea>
                                    @error('soal')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($test->tipe == 'berganda')
                                    
                                <div class="form-group">
                                    <label for="pilihan_a">Pilihan A</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="radio" name="jawaban" value="pilihan_a" required>
                                        </span>
                                        <input type="text" class="form-control" id="pilihan_a" name="pilihan_a" value="{{ old('pilihan_a', '') }}" required placeholder="Masukan pilihan A">
                                    </div>
                                    @error('pilihan_a')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_b">Pilihan B</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="radio" name="jawaban" value="pilihan_b" required>
                                        </span>
                                        <input type="text" class="form-control" id="pilihan_b" name="pilihan_b" value="{{ old('pilihan_b', '') }}" required placeholder="Masukan pilihan B">
                                    </div>
                                    @error('pilihan_b')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_c">Pilihan C</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="radio" name="jawaban" value="pilihan_c" required>
                                        </span>
                                        <input type="text" class="form-control" id="pilihan_c" name="pilihan_c" value="{{ old('pilihan_c', '') }}" required placeholder="Masukan pilihan C">
                                    </div>
                                    @error('pilihan_c')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_d">Pilihan D</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" name="jawaban" value="pilihan_d" required>
                                            <input type="radio">
                                        </span>
                                        <input type="text" class="form-control" id="pilihan_d" name="pilihan_d" value="{{ old('pilihan_d', '') }}" required placeholder="Masukan pilihan D">
                                    </div>
                                    @error('pilihan_d')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pilihan_e">Pilihan E</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <input type="radio" name="jawaban" value="pilihan_e" required>
                                        </span>
                                        <input type="text" class="form-control" id="pilihan_e" name="pilihan_e" value="{{ old('pilihan_e', '') }}" required placeholder="Masukan pilihan E">
                                    </div>
                                    @error('pilihan_e')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                                
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
                        <th style="width: 15px">No Soal</th>
                        <th>Soal</th>
                        @if ($test->tipe == 'berganda')
                        <th>Jawaban</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($soal as $item)
                    <tr>
                        <td>{{ $item->nomor_soal }}</td>
                        <td>{!! $item->soal !!}</td>
                        @if ($test->tipe == 'berganda')
                        <td>{{ $item->pilihan }}</td>
                        @endif
                        <td>
                            {{-- <a href="{{ route('admin.test.soal', $item->id) }}" class="btn btn-xs bg-purple btn-flat">SOAL</a>
                            <a href="{{ route('admin.test.jawaban', $item->id) }}" class="btn btn-xs bg-olive btn-flat">JAWABAN</a> --}}
                            <form action="{{ route('admin.test.soal.delete', [$test->id, $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Yakin ingin menghapus soal?')" type="submit" class="btn btn-xs bg-maroon btn-flat">HAPUS</button>
                            </form>    
                        
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No Soal</th>
                        <th>Soal</th>
                        @if ($test->tipe == 'berganda')
                        <th>Jawaban</th>
                        @endif
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
<script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script>
    $(function() {
        $('.textarea').wysihtml5()
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
