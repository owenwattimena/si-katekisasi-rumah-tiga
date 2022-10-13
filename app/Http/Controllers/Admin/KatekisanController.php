<?php

namespace App\Http\Controllers\Admin;

use App\Models\Katekisan;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KatekisanController extends Controller
{
    public function index()
    {
        $data['katekisan'] =
            /**Katekisan::all();***/
            DB::table('katekisan AS k')
            ->select(
                [
                    'k.id',
                    'k.nama_lengkap',
                    'k.tempat_lahir',
                    'k.tanggal_lahir',
                    'k.jenis_kelamin',
                    'k.unit',
                    'k.sektor',
                    'k.telp_hp',
                    'k.status_katekumen',
                    'k.tahun_baptis',
                    'k.pendidikan',
                    'k.status',
                    'p.periode'
                ]
            )
            ->join('periode AS p', 'p.id', 'k.id_periode')
            ->where('p.aktif', true)
            ->get();
        $data['periode'] = count($data['katekisan']) > 0 ? $data['katekisan'][0]->periode : null;
        return view('admin.katekisan.index', $data);
    }
    public function show($id)
    {
        $data['katekisan'] = Katekisan::findOrFail($id);
        return view('admin.katekisan.detail', $data);
    }

    public function status($id, $status)
    {
        $katekisan = Katekisan::findOrFail($id);

        $katekisan->status_katekumen = $status;

        if($katekisan->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Status berhasil di perbarui!'));
        }
        return redirect()->back()->with(AlertFormatter::success('Status gagal di perbarui!'));
    }
}
