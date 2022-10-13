<?php

namespace App\Services;

use Auth;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class JadwalService
{
    static function getJadwal($showPast = true, $user = 0)
    {
        $data = DB::table('jadwal AS j')
            ->select(['j.id', 'j.uniq_id', 'j.tanggal', 'j.jam', 'j.tempat', 'p.name', 'pe.periode',])
            ->join('users AS p', 'p.id', 'j.id_pengajar')
            ->join('periode AS pe', 'pe.id', 'j.id_periode')
            ->where('pe.aktif', true);
        if($user != 0)
        {
            $data = $data->where('p.id', $user);
        }
        if (!$showPast) {
            $data = $data->where('j.tanggal', '>=', date('Y-m-d'));
        }
        return $data->orderBy('j.tanggal', 'DESC')
            ->get();
    }

    static function absen($request) : bool
    {
        $jadwal = Jadwal::where('uniq_id', $request->id)->first();
        
        if($jadwal->jam >= date('H:i:s')){
            return false;
        }
        if($request->id_jadwal == $jadwal->id){
            $abs = Absensi::where('id_katekisan', Auth::guard('katekisan')->user()->id)->where('id_jadwal', $request->id_jadwal)->get();
            if(count( $abs ) > 0 ) return false;
            $absensi = new Absensi;
            $absensi->id_katekisan = Auth::guard('katekisan')->user()->id;
            $absensi->id_jadwal     = $request->id_jadwal;
            if($absensi->save())
            {
                return true;
            }
        }
        return false;
    }
}
