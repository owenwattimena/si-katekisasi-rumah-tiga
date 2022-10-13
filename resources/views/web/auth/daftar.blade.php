@extends('web.templates.index')

@section('style')
<style>
    .form-label {
        font-weight: 500 !important;
    }

    .form-control {
        border-radius: 0 !important;
    }

</style>

@endsection

@section('content')
<div class="container">
    <form action="{{ route('daftar.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center py-1">
            @if (!$periode)
              <h3 style="margin-bottom: 500px; margin-top:80px">BELUM ADA PERIODE</h3>  
            @else
            <div class="col-md-10">
                <h4 class="mb-5" style="margin-top:80px">PENDAFTARAN KATEKISASI</h4>
                <label for="" class="form-label mb-0">A. AKUN</label>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            @error('username')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Ulang Kata Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulang Kata Sandi" required>
                        </div>
                    </div>
                </div>
                <label for="" class="form-label mt-3 mb-0">B. KATEKISAN</label>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            <input type="hidden" name="id_periode" value="{{ $periode->id }}">
                            <select class="form-control" id="periode" name="id_periode" disabled required>
                                <option value="{{ $periode->id }}">{{ $periode->periode }}</option>
                            </select>
                            @error('periode')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama_lengkap" value="{{ old('nama') }}" placeholder="Nama Lengkap" required>
                            @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="panggilan" class="form-label">Nama Panggilan</label>
                            <input type="text" class="form-control" id="panggilan" name="nama_panggilan" value="{{ old('nama_panggilan') }}" placeholder="Nama Panggilan" required>
                            @error('nama_panggilan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir" required>
                            @error('tempat_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Tanggal Lahir" required>
                            @error('tanggal_lahir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'Selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'Selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="anak_ke" class="form-label">Anak Ke-</label>
                            <input type="text" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke') }}" placeholder="Anak Ke-" required>
                            @error('nak_ke')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}" placeholder="Unit" required>
                            @error('unit')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sektor" class="form-label">Sektor</label>
                            <input type="text" class="form-control" id="sektor" name="sektor" value="{{ old('sektor') }}" placeholder="Sektor" required>
                            @error('sektor')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tahun_baptis" class="form-label">Tahun Baptis</label>
                            <input type="text" class="form-control" id="tahun_baptis" name="tahun_baptis" value="{{ old('tahun_baptis') }}" placeholder="Tahun Baptis" required>
                            @error('tahun_baptis')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}" placeholder="Pendidikan" required>
                            @error('pendidikan')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ old('status') }}" placeholder="status" required>
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telp_hp" class="form-label">Telp/HP</label>
                            <input type="text" class="form-control" id="telp_hp" name="telp_hp" value="{{ old('telp_hp') }}" placeholder="Telp/HP" required>
                            @error('telp_hp')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pas_foto" class="form-label">Pas Foto</label>
                            <input type="file" class="form-control" id="pas_foto" name="pas_foto" required>
                            @error('pas_foto')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ijazah_terakhir" class="form-label">Ijazah Teerakhir</label>
                            <input type="file" class="form-control" id="ijazah_terakhir" name="ijazah_terakhir" required>
                            @error('ijazah_terakhir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sertifikat_wasmi" class="form-label">Sertifikat Wasmi</label>
                            <input type="file" class="form-control" id="sertifikat_wasmi" name="sertifikat_wasmi" required>
                            @error('sertifikat_wasmi')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="akte_kelahiran" class="form-label">Akte Kelahiran</label>
                            <input type="file" class="form-control" id="akte_kelahiran" name="akte_kelahiran" required>
                            @error('akte_kelahiran')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <label for="" class="form-label mt-3 mb-0">C. ORANG TUA</label>
                <hr>
                <label for="" class="form-label mb-0">I. AYAH</label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pekerjaan_ayah" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="unit_ayah" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit_ayah" name="unit_ayah" placeholder="Unit">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sektor_ayah" class="form-label">Sektor</label>
                            <input type="text" class="form-control" id="sektor_ayah" name="sektor_ayah" placeholder="Sektor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telp_hp_ayah" class="form-label">Telp/HP</label>
                            <input type="text" class="form-control" id="telp_hp_ayah" name="telp_hp_ayah" placeholder="Telp/HP">
                        </div>
                    </div>
                </div>
                <label for="" class="form-label mb-0">II. IBU</label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pekerjaan_ibu" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="unit_ibu" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit_ibu" name="unit_ibu" placeholder="Unit">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sektor_ibu" class="form-label">Sektor</label>
                            <input type="text" class="form-control" id="sektor_ibu" name="sektor_ibu" placeholder="Sektor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telp_hp_ibu" class="form-label">Telp/HP</label>
                            <input type="text" class="form-control" id="telp_hp_ibu" name="telp_hp_ibu" placeholder="Telp/HP">
                        </div>
                    </div>
                </div>
                <label for="" class="form-label mb-0">II. WALI</label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="nama_wali" class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" id="nama_wali" name="nama_wali" placeholder="Nama Ibu">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pekerjaan_wali" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="unit_wali" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit_wali" name="unit_wali" placeholder="Unit">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sektor_wali" class="form-label">Sektor</label>
                            <input type="text" class="form-control" id="sektor_wali" name="sektor_wali" placeholder="Sektor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telp_hp_wali" class="form-label">Telp/HP</label>
                            <input type="text" class="form-control" id="telp_hp_wali" name="telp_hp_wali" placeholder="Telp/HP">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn w100 btn-primary form-control mt-3 mb-5">DAFTAR</button>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </form>

</div>
@endsection
