<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Periode;
use App\Models\Katekisan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    public function viewMasuk()
    {
        return view('web.auth.masuk');
    }

    public function masuk(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $katekisan = Katekisan::where('username', $request->username)->first();
        if ($katekisan && $katekisan->status_katekumen != 1) {
            return redirect()->back()->with(AlertFormatter::danger('Status akun anda ' . Config::get('app.status_katekumen', 'default')[$katekisan->status_katekumen]));
        }

        if (Auth::guard('katekisan')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect()->back()->with(AlertFormatter::danger('Username atau Password salah!'));
    }

    public function viewDaftar()
    {
        $data['periode'] = Periode::where('aktif', true)->first();
        return view('web.auth.daftar', $data);
    }

    public function daftar(Request $request)
    {
        // dd($request->input());
        $request->validate([
            "username"               => "required|unique:katekisan",
            "password"          => "required|confirmed",
            "nama_lengkap"      => "required",
            "nama_panggilan"    => "required",
            "tempat_lahir"      => "required",
            "tanggal_lahir"     => "required",
            "jenis_kelamin"     => "required",
            "anak_ke"           => "required",
            "unit"              => "required",
            "sektor"            => "required",
            "tahun_baptis"      => "required",
            "pendidikan"        => "required",
            "status"            => "required",
            "telp_hp"           => "required",
            "pas_foto"          => "required",
            "ijazah_terakhir"   => "required",
            "sertifikat_wasmi"  => "required",
            "akte_kelahiran"    => "required"
        ]);


        $pas_foto_path = null;
        $ijazah_terakhir_path = null;
        $sertifikat_wasmi_path = null;
        $akte_kelahiran_path = null;

        if ($request->hasFile('pas_foto')) {
            $image = $request->file('pas_foto');
            $image_extension = $image->getClientOriginalExtension();
            $pas_foto   = uniqid(rand(), true) . '.' . $image_extension;
            $image->move(public_path('/pas_foto'), $pas_foto);

            $pas_foto_path = "/pas_foto/" . $pas_foto;
        }

        if ($request->hasFile('ijazah_terakhir')) {
            $image = $request->file('ijazah_terakhir');
            $image_extension = $image->getClientOriginalExtension();
            $ijazah_terakhir   = uniqid(rand(), true) . '.' . $image_extension;
            $image->move(public_path('/ijazah_terakhir'), $ijazah_terakhir);

            $ijazah_terakhir_path = "/ijazah_terakhir/" . $ijazah_terakhir;
        }

        if ($request->hasFile('sertifikat_wasmi')) {
            $image = $request->file('sertifikat_wasmi');
            $image_extension = $image->getClientOriginalExtension();
            $sertifikat_wasmi   = uniqid(rand(), true) . '.' . $image_extension;
            $image->move(public_path('/sertifikat_wasmi'), $sertifikat_wasmi);

            $sertifikat_wasmi_path = "/sertifikat_wasmi/" . $sertifikat_wasmi;
        }

        if ($request->hasFile('akte_kelahiran')) {
            $image = $request->file('akte_kelahiran');
            $image_extension = $image->getClientOriginalExtension();
            $akte_kelahiran   = uniqid(rand(), true) . '.' . $image_extension;
            $image->move(public_path('/akte_kelahiran'), $akte_kelahiran);

            $akte_kelahiran_path = "/akte_kelahiran/" . $akte_kelahiran;
        }

        $katekisan          = new Katekisan;
        $katekisan->username     = $request->username;
        $katekisan->password = Hash::make($request->password);
        $katekisan->nama_lengkap     = $request->nama_lengkap;
        $katekisan->nama_panggilan     = $request->nama_panggilan;
        $katekisan->tempat_lahir     = $request->tempat_lahir;
        $katekisan->tanggal_lahir     = $request->tanggal_lahir;
        $katekisan->jenis_kelamin     = $request->jenis_kelamin;
        $katekisan->anak_ke     = $request->anak_ke;
        $katekisan->unit     = $request->unit;
        $katekisan->sektor     = $request->sektor;
        $katekisan->tahun_baptis     = $request->tahun_baptis;
        $katekisan->pendidikan     = $request->pendidikan;
        $katekisan->status     = $request->status;
        $katekisan->telp_hp     = $request->telp_hp;
        $katekisan->nama_ayah     = $request->nama_ayah;
        $katekisan->pekerjaan_ayah     = $request->pekerjaan_ayah;
        $katekisan->unit_ayah     = $request->unit_ayah;
        $katekisan->sektor_ayah     = $request->sektor_ayah;
        $katekisan->telp_hp_ayah     = $request->telp_hp_ayah;
        $katekisan->nama_ibu     = $request->nama_ibu;
        $katekisan->pekerjaan_ibu     = $request->pekerjaan_ibu;
        $katekisan->unit_ibu     = $request->unit_ibu;
        $katekisan->sektor_ibu     = $request->sektor_ibu;
        $katekisan->telp_hp_ibu     = $request->telp_hp_ibu;
        $katekisan->nama_wali     = $request->nama_wali;
        $katekisan->pekerjaan_wali     = $request->pekerjaan_wali;
        $katekisan->unit_wali     = $request->unit_wali;
        $katekisan->sektor_wali     = $request->sektor_wali;
        $katekisan->telp_hp_wali     = $request->telp_hp_wali;
        $katekisan->pas_foto     = $pas_foto_path;
        $katekisan->ijazah_terakhir     = $ijazah_terakhir_path;
        $katekisan->sertifikat_wasmi     = $sertifikat_wasmi_path;
        $katekisan->akte_kelahiran     = $akte_kelahiran_path;
        $katekisan->id_periode      = $request->id_periode;

        if ($katekisan->save()) {
            return redirect()->back()->with(AlertFormatter::success('Pendaftaran berhasil!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Pendaftaran gagal!'));
    }

    public function keluar(Request $request)
    {
        Auth::guard('katekisan')->logout();
        return redirect()->route('masuk');
    }
}
