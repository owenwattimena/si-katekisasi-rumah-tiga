<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
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
                "soal"          => "required|file",
            ]
        );

        $tes = new Test;
        $tes->id_periode = $request->id_periode;
        $tes->tanggal = $request->tanggal;
        $tes->jam_mulai = $request->jam_mulai;
        $tes->jam_selesai = $request->jam_selesai;
        $tes->judul = $request->judul;
        $tes->keterangan = $request->keterangan;

        if ($request->hasFile('soal')) {
            $image = $request->file('soal');
            $image_extension = $image->getClientOriginalExtension();
            $soal   = uniqid(rand(), true) . '.' . $image_extension;
            $image->move(public_path('/soal'), $soal);

            $soal_path = "/soal/" . $soal;

            $tes->soal = $soal_path;
        }

        if($tes->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Soal berhasil di tambahkan!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Soal gagal di tambahkan!'));
    }

    public function jawaban($id)
    {
        $data['jawaban'] = Test::with(['jawaban' => function($query){
            return $query->with('katekisan')->first();
        }])->where('id', $id)->first();
        return view('admin.test.jawaban', $data);
    }
}
