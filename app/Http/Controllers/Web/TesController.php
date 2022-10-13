<?php

namespace App\Http\Controllers\Web;

use App\Models\Test;
use App\Models\Jawaban;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;

class TesController extends Controller
{
    public function index()
    {
        $periode = Periode::where('aktif', true)->first();

        $data['test'] = Test::with(['jawaban' => function($query){
            return $query->leftJoin('katekisan', 'katekisan.id', 'jawaban_tes.id_katekisan')->where('jawaban_tes.id_katekisan', auth()->user()->id)->first();
        }])->where('id_periode', $periode->id)
        ->where('tanggal', '>=', date('Y-m-d'))
        ->where('jam_mulai', '<=', date('H:i'))
        ->get();
        return view('web.test.index', $data);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'jawaban' => "required|file"
        ]);

        $check  = Jawaban::where('id_tes', $id)->where('id_katekisan', auth()->guard('katekisan')->user()->id)->first();
        if($check) return redirect()->back()->with(AlertFormatter::info('Tes sudah di jawab!'));

        if ($request->hasFile('jawaban')) {
            $image = $request->file('jawaban');
            $image_extension = $image->getClientOriginalExtension();
            $jawaban   = uniqid(rand(), true) . '.' . $image_extension;
            $image->move(public_path('/jawaban'), $jawaban);

            $jawaban_path = "/jawaban/" . $jawaban;
            $jawaban = new Jawaban;
            $jawaban->id_tes = $id;
            $jawaban->id_katekisan = auth()->guard('katekisan')->user()->id;
            $jawaban->jawaban = $jawaban_path;
            if($jawaban->save())
            {
                return redirect()->back()->with(AlertFormatter::success('Jawaban berhasil di unggah!'));
            }
        }
        return redirect()->back()->with(AlertFormatter::success('Jawaban gagal di unggah!'));
    }
}
