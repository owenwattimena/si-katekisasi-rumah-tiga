<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\AlertFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PengajarController extends Controller
{
    public function index()
    {
        $data['pengajar'] = DB::table('users')->where('akses', 'pengajar')->get();
        return view('admin.pengajar.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"  => "required",
            "username" => "required|unique:users",
            "password" => "required"
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make( $request->password );
        $user->akses = "pengajar";

        if($user->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Pengajar berhasil di tambahkan!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Pengajar gagal di tambahkan!'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name"  => "required",
            "username" => "required|unique:users,username," . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        
        if($request->password)
        {
            $user->password = Hash::make( $request->password );
        }

        if($user->save())
        {
            return redirect()->back()->with(AlertFormatter::success('Pengajar berhasil di tambahkan!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Pengajar gagal di tambahkan!'));
    }
    
    public function delete($id)
    {
        if(User::findOrFail($id)->delete())
        {
            return redirect()->back()->with(AlertFormatter::success('Pengajar berhasil di hapus!'));
        }
        return redirect()->back()->with(AlertFormatter::danger('Pengajar gagal di hapus!'));
    }
}
