<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $production = \App\Models\ResultProduction::orderBy('id', 'desc')->get();

        if(!$production) {
            return response([
                'status' => false,
                'message' => 'Tidak ada data Produksi Product',
                'data' => [],
            ], 404);
        }

        return response([
            'status' => true,
            'message' => 'List data Produksi Product',
            'data' => $production,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule' => 'required|string',
            'actual' => 'required|string',
            'shift' => 'required|string',
            'group' => 'required|string',
        ]);

        $production = \App\Models\ResultProduction::create([
            'schedule' => $request->schedule,
            'actual' => $request->actual,
            'shift' => $request->shift,
            'group' => $request->group,
        ]);

        if($production) {
            return response()->json([
                'success' => true,
                'message' => 'Data Produksi Product berhasil dibuat dan disimpan',
                'data' => $production,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Produksi Product gagal dibuat dan disimpan',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'schedule' => 'sometimes|required|string',
                'actual' => 'sometimes|required|string',
                'shift' => 'sometimes|required|string',
                'group' => 'sometimes|required|string',
            ]);

            if($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json([
                    'success' => false,
                    'message' => $error,
                ], 422);
            } else {
                $production = \App\Models\ResultProduction::find($id);

                $production->schedule = $request->schedule ?? $production->schedule;
                $production->actual = $request->actual ?? $production->actual;
                $production->shift = $request->shift ?? $production->shift;
                $production->group = $request->group ?? $production->group;



                $production->update();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Produksi Product berhasil diperbarui',
                    'data' => $production,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $production = \App\Models\ResultProduction::find($id);

            if (!$production) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Produksi Product tidak ditemukan!',
                ], 404);
            }

            $production->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Produksi Product berhasil dihapus',
                'data' => $production,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message'=> 'Terjadi kesalahan saat menghapus Data Produksi Product: ' . $e->getMessage(),
            ], 422);
        }
    }
}