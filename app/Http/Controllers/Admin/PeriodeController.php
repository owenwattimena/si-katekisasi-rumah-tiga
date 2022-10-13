<?php

namespace App\Http\Controllers\Admin;

use App\Models\Periode;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PeriodeController extends Controller
{
    public function index()
    {
        $data['periode'] = Periode::all();
        return view('admin.periode.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "periode" => "required"
        ]);
        
        DB::beginTransaction();
        try {
            DB::table('periode')->where('aktif', true)->update(['aktif' => false]);

            Periode::create([
                'periode' => $request->periode
            ]);
            
            DB::commit();

            return redirect()->back()->with(AlertFormatter::success('Periode berhasil di tambahkan!'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(AlertFormatter::danger('Periode gagal di tambahkan! ' . $e->getMessage()));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "periode" => "required"
        ]);

        $periode    = Periode::findOrFail($id);
        $periode->periode = $request->periode;

        if ($periode->save()) {
            return redirect()->back()->with(AlertFormatter::success('Periode berhasil di ubah!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Periode gagal di ubah!'));
    }

    public function status($id)
    {
        return DB::transaction(function () use ($id) {
            $periode = Periode::findOrFail($id);
            if ($periode->aktif == true) {
                $periode->aktif = false;
            } else {
                Periode::where('aktif', true)->update(['aktif' => false]);
                $periode->aktif = true;
            }

            if ($periode->save()) {

                return redirect()->back()->with(AlertFormatter::success('Status periode berhasil di ubah!'));
            }
            return redirect()->back()->with(AlertFormatter::danger('Status periode gagal di ubah!'));
        });
    }

    public function delete($id)
    {
        if (Periode::destroy($id)) {
            return redirect()->back()->with(AlertFormatter::success('Periode berhasil di hapus!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Periode gagal di hapus!'));
    }
}
