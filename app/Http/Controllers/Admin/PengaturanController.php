<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengaturanController extends Controller
{
    public function index()
    {
        $data['pengaturan'] = DB::table('pengaturan')->get();
        return view('admin.pengaturan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "beranda" => "required",
        ]);

        $result = DB::table('pengaturan')->get();

        if(count($result) <= 0)
        {
            $result = DB::table('pengaturan')->insert([
                "beranda" => $request->beranda
            ]);

            if($result)
            {
                return redirect()->back()->with(AlertFormatter::success('Pengaturan berhasil diubah!'));
            }
        }else{
            $result = DB::table('pengaturan')->update([
                "beranda" => $request->beranda
            ]);
            
            if($result > 0)
            {
                return redirect()->back()->with(AlertFormatter::success('Pengaturan berhasil diubah!'));
            }
        }
        return redirect()->back()->with(AlertFormatter::danger('Pengaturan gagal diubah!'));
    }
}
