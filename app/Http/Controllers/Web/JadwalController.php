<?php

namespace App\Http\Controllers\Web;

use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Services\JadwalService;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    public function index()
    {
        $data['jadwal'] = Jadwal::with(['pengajar', 'absensi' => function($q){
            return $q->katekisan();
        }])->whereHas('periode', function($query){
            return $query->where('aktif', 1);
        })->where('tanggal', '>=', date('Y-m-d'))->orderBy('tanggal', 'asc')->orderBy('jam', 'asc')->get();
        // dd($data);
        return view('web.jadwal.index', $data);//133707
    }
    public function show($id)
    {
        $data['id'] = $id;
        $abs = Absensi::where('id_katekisan', \Auth::guard('katekisan')->user()->id)->where('id_jadwal', $id)->first();
        if($abs) return back()->with(AlertFormatter::info('Sudah Absen!'));
        return view('web.jadwal.absen', $data);
    }
    public function absen(Request $request)
    {
        if(JadwalService::absen($request))
        {
            return redirect()->route('jadwal')->with(AlertFormatter::success('Absensi berhasil!'));
        }
        return redirect()->route('jadwal')->with(AlertFormatter::danger('Absensi gagal! Pastikan anda absen pada kelas yang benar.'));
    }
}
