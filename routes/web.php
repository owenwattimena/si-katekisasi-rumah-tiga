<?php

use App\Models\Katekisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TesController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\PengajarController;
use App\Http\Controllers\Admin\KatekisanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\TesController as AdminTesController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Web\JadwalController as WebJadwalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data['beranda'] = DB::table('pengaturan')->first();
    return view('web.home', $data);
});

Route::middleware(['auth:katekisan'])->group(function () {
    Route::get('/jadwal', [WebJadwalController::class, 'index'])->name('jadwal');
    Route::get('/jadwal/{id}', [WebJadwalController::class, 'show'])->name('jadwal.show');
    Route::post('/absen', [WebJadwalController::class, 'absen'])->name('jadwal.absen');
    Route::get('/tes', [TesController::class, 'index'])->name('tes');
    Route::post('/tes/{id}', [TesController::class, 'store'])->name('tes.post');
});

Route::get('pengumuman', function(){
    $data['katekisan'] =  Katekisan::where('status_katekumen', 3)->get();
    return view('web.pengumuman.index', $data);
})->name('pengumuman');

Route::get('/daftar', [AuthController::class, 'viewDaftar'])->name('daftar');
Route::post('daftar', [AuthController::class, 'daftar'])->name('daftar.post');
Route::get('/masuk', [AuthController::class, 'viewMasuk'])->name('masuk');
Route::post('/masuk', [AuthController::class, 'masuk'])->name('masuk.post');
Route::get('/keluar', [AuthController::class, 'keluar'])->name('keluar');


Route::middleware(['auth'])->group(function () {

    Route::get('admin/dashboard', function(){
        return view('admin.dashboard.index');
    })->name('admin.dashboard');

    Route::middleware(['admin'])->group(function () {
        Route::get('admin/periode', [PeriodeController::class, 'index'])->name('admin.periode');
        Route::post('admin/periode', [PeriodeController::class, 'store'])->name('admin.periode.post');
        Route::put('admin/periode/{id}', [PeriodeController::class, 'update'])->name('admin.periode.put');
        Route::get('admin/periode/{id}/delete', [PeriodeController::class, 'delete'])->name('admin.periode.delete');
        Route::get('admin/periode/{id}/status', [PeriodeController::class, 'status'])->name('admin.periode.status');

        Route::get('admin/katekisan', [KatekisanController::class, 'index'])->name('admin.katekisan');
        Route::get('admin/katekisan/{id}', [KatekisanController::class, 'show'])->name('admin.katekisan.show');
        Route::get('admin/katekisan/{id}/status/{status}', [KatekisanController::class, 'status'])->name('admin.katekisan.status');

        Route::get('admin/pengajar', [PengajarController::class, 'index'])->name('admin.pengajar');
        Route::post('admin/pengajar', [PengajarController::class, 'store'])->name('admin.pengajar.post');
        Route::put('admin/pengajar/{id}', [PengajarController::class, 'update'])->name('admin.pengajar.put');
        Route::get('admin/pengajar/{id}/hapus', [PengajarController::class, 'delete'])->name('admin.pengajar.delete');
    });


    Route::get('admin/jadwal', [JadwalController::class, 'index'])->name('admin.jadwal');
    Route::post('admin/jadwal', [JadwalController::class, 'store'])->name('admin.jadwal.post');
    Route::put('admin/jadwal/{id}', [JadwalController::class, 'update'])->name('admin.jadwal.put');
    Route::get('admin/jadwal/{id}/absensi', [JadwalController::class, 'absensi'])->name('admin.jadwal.absensi');
    Route::get('admin/jadwal/{id}/delete', [JadwalController::class, 'delete'])->name('admin.jadwal.delete');

    Route::get('admin/tes', [AdminTesController::class, 'index'])->name('admin.test');
    Route::post('admin/tes', [AdminTesController::class, 'store'])->name('admin.test.post');
    Route::get('admin/tes/{id}', [AdminTesController::class, 'jawaban'])->name('admin.test.jawaban');
    
    Route::get('/template', function () {
        return view('admin.templates.template');
    });
    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::get('admin/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan');
    Route::post('admin/pengaturan', [PengaturanController::class, 'store'])->name('admin.pengaturan.post');
});
Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
