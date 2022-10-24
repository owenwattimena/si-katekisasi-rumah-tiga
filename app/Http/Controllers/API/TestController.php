<?php

namespace App\Http\Controllers\API;

use App\Models\Soal;
use App\Models\Test;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use App\Models\DetailJawabanEssay;
use App\Http\Controllers\Controller;
use App\Models\DetailJawabanBerganda;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{

    public function getTest(Request $request, $id)
    {
        $idKatekisan = $request->user()->id;
        $result = Jawaban::with(['detailJawabanBerganda', 'detailJawabanEssay'])->where('id_katekisan', $idKatekisan)
            ->where('id_tes', $id)
            ->first();
        return response()->json($result, 200);
    }

    public function getSoal($idTest)
    {
        $tes = Test::findOrFail($idTest);
        if($tes->tipe == 'berganda'){
            $result = Soal::with(['pilihan' => function ($query) {
                return $query->get()->shuffle();
            }])->where('id_tes', $idTest)->get()->shuffle();
        }else{
            $result = Soal::where('id_tes', $idTest)->get()->shuffle();
        }

        return response()->json($result, 200);
    }

    public function postJawaban(Request $request, $id, $idJawaban)
    {

        $tes = Test::findOrFail($id);
        if($tes->tipe == 'berganda')
        {
            $validator = Validator::make($request->all(), [
                "id_soal"   => "required",
                "id_pilihan_jawaban" => "required"
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                "id_soal"   => "required",
                "jawaban" => "required"
            ]); 
        }

        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()->first()
            ], 400);
        }
        try {
            if($tes->tipe == 'berganda')
            {
                DetailJawabanBerganda::updateOrCreate(
                    ['id_jawaban' => $idJawaban, 'id_soal' => $request->id_soal],
                    ['id_pilihan_jawaban' => $request->id_pilihan_jawaban]
                );
            }else{
                DetailJawabanEssay::updateOrCreate(
                    ['id_jawaban' => $idJawaban, 'id_soal' => $request->id_soal],
                    ['jawaban' => $request->jawaban]
                );
            }
            return response()->json([], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Gagal menyimpan jawaban. " . $e->getMessage()
            ], 400);
        }
    }

    public function testFinish(Request $request, $idTes)
    {
        try {
            $test = Jawaban::findOrFail($idTes);
            $test->jam_selesai = date('H:i:s');
            if ($test->save()) {
                return response()->json([], 200);
            }
            return response()->json([
                "message" => "Gagal menyimpan jawaban. "
            ], 400);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Gagal menyimpan jawaban. " . $e->getMessage()
            ], 400);
        }
    }
}
