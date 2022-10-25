<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Services\JadwalService;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalController extends Controller
{
    public function index()
    {
        $data['pengajar'] = User::where('akses', 'pengajar')->get();
        if(auth()->user()->akses == 'admin'){
            $data['jadwal'] = JadwalService::getJadwal();
        }else{
            $data['jadwal'] = JadwalService::getJadwal(true, auth()->user()->id);
        }

        $data['periode'] = Periode::where('aktif', true)->first();

        return view('admin.jadwal.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "tanggal" => "required|date",
            "jam"       => "required",
            "tempat"    => "required",
            "pengajar"  => "required",
            "periode"  => "required"
        ]);

        $jadwal     = new Jadwal;
        $jadwal->uniq_id = md5(uniqid());
        $jadwal->tanggal = $request->tanggal;
        $jadwal->jam = $request->jam;
        $jadwal->tempat = $request->tempat;
        $jadwal->id_pengajar = $request->pengajar;
        $jadwal->id_periode = $request->periode;

        if($jadwal->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Jadwal berhasil di tambahkan!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Jadwal gagal di tambahkan!'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "tanggal" => "required|date",
            "jam"       => "required",
            "tempat"    => "required",
            "pengajar"  => "required",
            "periode"  => "required"
        ]);

        $jadwal     = Jadwal::findOrFail($id);
        $jadwal->uniq_id = md5(uniqid());
        $jadwal->tanggal = $request->tanggal;
        $jadwal->jam = $request->jam;
        $jadwal->tempat = $request->tempat;
        $jadwal->id_pengajar = $request->pengajar;
        $jadwal->id_periode = $request->periode;

        if($jadwal->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Jadwal berhasil di ubah!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Jadwal gagal di ubah!'));
    }

    public function absensi($id)
    {
        $data['jadwal'] = Jadwal::where('id', $id)->first();
        $data['absensi'] = Absensi::with(['katekisan' => function($q){
            return $q->showLess();
        }])->where('id_jadwal', $id)->get();
        return view('admin.jadwal.absensi', $data);
    }
    
    public function downloadAbsen($id)
    {
        $data['jadwal'] = Jadwal::where('id', $id)->first();
        $data['absensi'] = Absensi::with(['katekisan' => function($q){
            return $q->showLess();
        }])->where('id_jadwal', $id)->get();
        $pdf = Pdf::loadView('admin.jadwal.pdf', $data);
        return $pdf->download('daftar-hadir.pdf');
        // return view('admin.jadwal.pdf', $data);
    }

    public function delete($id)
    {
        try {
            if(Jadwal::findOrFail($id)->delete($id))
            {
                return redirect()->back()->with(AlertFormatter::success('Jadwal berhasil di hapus!'));
            }
            return redirect()->back()->with(AlertFormatter::danger('Jadwal gagal di hapus!'));
            
        } catch (\Throwable $e) {
            return redirect()->back()->with(AlertFormatter::danger('Jadwal gagal di hapus! ' . $e->getMessage()));
        }
    }
}
