<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TesController extends Controller
{
    public function index()
    {
        $data['periode'] = Periode::where('aktif', true)->first();
        $data['test'] = Test::where('id_periode', $data['periode']->id)->get();

        return view('admin.test.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "id_periode"    => "required",
                "tanggal"       => "required|date",
                "jam_mulai"     => "required",
                "jam_selesai"   => "required",
                "judul"         => "required",
                "keterangan"    => "required",
                "tipe"          => "required",
            ]
        );

        $tes = new Test;
        $tes->id_periode = $request->id_periode;
        $tes->tanggal = $request->tanggal;
        $tes->jam_mulai = $request->jam_mulai;
        $tes->jam_selesai = $request->jam_selesai;
        $tes->tipe = $request->tipe;
        $tes->judul = $request->judul;
        $tes->keterangan = $request->keterangan;

        if ($tes->save()) {
            return redirect()->back()->with(AlertFormatter::success('Soal berhasil di tambahkan!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Soal gagal di tambahkan!'));
    }

    public function soal($id)
    {
        $data['test'] = Test::findOrFail($id);
        if ($data['test']->tipe == 'berganda') {
            $data['soal'] = DB::table('soal AS s')
                ->select(['s.id', 's.nomor_soal', 's.soal', 'pjb.pilihan'])
                ->join('pilihan_jawaban_berganda AS pjb', 's.id', 'pjb.id_soal')
                ->where('id_tes', $data['test']->id)
                ->where('pjb.jawaban', true)
                ->orderBy('s.nomor_soal')
                ->get();
        } else {
            $data['soal'] = DB::table('soal AS s')
                ->select(['s.id', 's.nomor_soal', 's.soal'])
                ->where('id_tes', $data['test']->id)
                ->orderBy('s.nomor_soal')
                ->get();
        }
        return view('admin.test.soal', $data);
    }

    public function storeSoal(Request $request, $id)
    {
        $test = Test::findOrFail($id);

        if ($test->tipe == 'berganda') {
            $request->validate([
                "nomor_soal" => "required",
                "soal" => "required",
                "pilihan_a" => "required",
                "pilihan_b" => "required",
                "pilihan_c" => "required",
                "pilihan_d" => "required",
                "pilihan_e" => "required",
                "jawaban" => "required",
            ]);
        } else {
            $request->validate([
                "nomor_soal" => "required",
                "soal" => "required",
            ]);
        }


        try {

            DB::transaction(function () use ($id, $request, $test) {
                $idSoal = DB::table('soal')->insertGetId([
                    "id_tes" => $id,
                    "nomor_soal" => $request->nomor_soal,
                    "soal" => $request->soal
                ]);


                if ($test->tipe == 'berganda') {
                    // PILIHAN A
                    DB::table('pilihan_jawaban_berganda')->insertGetId([
                        "id_soal" => $idSoal,
                        "nomor_pilihan" => "a",
                        "pilihan" => $request->pilihan_a,
                        "jawaban"   => $request->jawaban == "pilihan_a"
                    ]);
                    // PILIHAN B
                    DB::table('pilihan_jawaban_berganda')->insertGetId([
                        "id_soal" => $idSoal,
                        "nomor_pilihan" => "b",
                        "pilihan" => $request->pilihan_b,
                        "jawaban"   => $request->jawaban == "pilihan_b"
                    ]);
                    // PILIHAN C
                    DB::table('pilihan_jawaban_berganda')->insertGetId([
                        "id_soal" => $idSoal,
                        "nomor_pilihan" => "c",
                        "pilihan" => $request->pilihan_c,
                        "jawaban"   => $request->jawaban == "pilihan_c"
                    ]);
                    // PILIHAN D
                    DB::table('pilihan_jawaban_berganda')->insertGetId([
                        "id_soal" => $idSoal,
                        "nomor_pilihan" => "d",
                        "pilihan" => $request->pilihan_d,
                        "jawaban"   => $request->jawaban == "pilihan_d"
                    ]);
                    // PILIHAN E
                    DB::table('pilihan_jawaban_berganda')->insertGetId([
                        "id_soal" => $idSoal,
                        "nomor_pilihan" => "e",
                        "pilihan" => $request->pilihan_e,
                        "jawaban"   => $request->jawaban == "pilihan_e"
                    ]);
                }
            });
            return redirect()->back()->with(AlertFormatter::success('Soal berhasil di tambahkan!'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger('Soal gagal di tambahkan!'));
        }
    }

    public function deleteSoal(Request $request, $idTest, $idSoal)
    {
        try {
            DB::transaction(function () use ($idTest, $idSoal) {
                DB::table('soal')->where('id', $idSoal)->delete();
            });
            return redirect()->back()->with(AlertFormatter::success('Soal berhasil di hapus!'));
        } catch (\Throwable $e) {
            return redirect()->back()->with(AlertFormatter::danger('Soal gagal di hapus!'));
        }
    }

    public function jawaban($id)
    {
        $data['jawaban'] = Test::with(['jawaban' => function ($query) {
            return $query->with('katekisan')->first();
        }])->where('id', $id)->first();
        return view('admin.test.jawaban', $data);
    }
}
