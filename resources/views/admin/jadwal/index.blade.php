@extends('admin.templates.template')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

@endsection

@section('body')
<section class="content-header">
    <h1>
        Jadwal
        <small>Data Jadwal</small>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-users"></i> Jadwal</li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Jadwal Periode {{ $periode ? $periode->periode : '-' }}</h3>
        </div>
        <div class="box-body">
            @if ($periode)

            <button class="btn btn-flat bg-olive" style="margin-bottom: 15px" data-toggle="modal" data-target="#modal-default">TAMBAH</button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.jadwal.post') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Tambah Jadwal</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tanggal">Periode</label>
                                    <input type="hidden" name="periode" value="{{ $periode->id }}">
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
                                <div class="form-group">
                                    <label for="jam">jam</label>
                                    <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam', '') }}" required>
                                    @error('jam')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tempat">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" value="{{ old('tempat', '') }}" required placeholder="Masukan Tempat">
                                    @error('tempat')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pengajar">Pengajar</label>
                                    <select class="form-control" id="pengajar" name="pengajar" required>
                                        @foreach ($pengajar as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pengajar')
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
            @endif

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Hari Tangal</th>
                        <th>Jam</th>
                        <th>Tempat</th>
                        <th>Pengajar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $item)
                    @php
                        $today = is_today($item->tanggal);
                    @endphp
                    <tr>
                        <td>{{ tanggal_indonesia($item->tanggal) }} @if($today) <small class="badge bg-green">HARI INI</small> @endif </td>
                        <td>{{ $item->jam }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <button class="btn btn-xs bg-black btn-flat" data-toggle="modal" data-target="#modal-qr-{{ $item->id }}" onclick="showQrCode(`{{ $item->id }}`, `{{ $item->uniq_id }}`)">QRCODE</button>
                            @if (auth()->user()->akses == 'admin')
                            <button class="btn btn-xs bg-orange btn-flat" data-toggle="modal" data-target="#modal-{{ $item->id }}">UBAH</button>
                            @endif
                            <a href="{{ route('admin.jadwal.absensi', $item->id) }}" class="btn btn-xs bg-purple btn-flat">DAFTAR HADIR</a>
                            @if (auth()->user()->akses == 'admin')
                            <a href="{{ route('admin.jadwal.delete', $item->id) }}" onclick="return confirm('Yakin ingin menghapus jadwal?')" class="btn btn-xs bg-maroon btn-flat">HAPUS</a>
                            @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-qr-{{ $item->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.jadwal.post') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Scan Untuk Absen</h4>
                                    </div>
                                    <div class="modal-body center">
                                        <div id="qrcode-{{ $item->id }}" class="barcode"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL UBAH --}}
                    <div class="modal fade" id="modal-{{ $item->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.jadwal.put', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Tambah Jadwal</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tanggal">Periode</label>
                                            <input type="hidden" name="periode" value="{{ $periode->id }}">
                                            <input type="text" class="form-control" id="tanggal" value="{{ old('periode', ($periode ? $periode->periode : '')) }}" readonly>
                                            @error('tanggal')
                                            <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $item->tanggal) }}" required>
                                            @error('tanggal')
                                            <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jam">jam</label>
                                            <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam', $item->jam) }}" required>
                                            @error('jam')
                                            <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="tempat">Tempat</label>
                                            <input type="text" class="form-control" id="tempat" name="tempat" value="{{ old('tempat', $item->tempat) }}" required placeholder="Masukan Tempat">
                                            @error('tempat')
                                            <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pengajar">Pengajar</label>
                                            <select class="form-control" id="pengajar" name="pengajar" required>
                                                @foreach ($pengajar as $value)
                                                <option value="{{ $value->id }}" {{ $item->id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pengajar')
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
                        <th>Hari Tangal</th>
                        <th>Jam</th>
                        <th>Tempat</th>
                        <th>Pengajar</th>
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

<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>
    function showQrCode(id, uniq_id) {
        $("#qrcode-" + id).html('');
        new QRCode(document.getElementById("qrcode-" + id), uniq_id);
    }
    $(function() {
        $('#example1').DataTable({ordering:false})
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
