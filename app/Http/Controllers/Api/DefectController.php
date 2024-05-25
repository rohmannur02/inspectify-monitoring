<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class DefectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = \App\Models\Defect::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('size', 'LIKE', "%{$search}%")
                ->orWhere('pattern', 'LIKE', "%{$search}%")
                ->orWhere('defect', 'LIKE', "%{$search}%")
                ->orWhere('status', 'LIKE', "%{$search}%");
            });
        }

        $defect = $query->orderBy('created_at', 'desc')->get();

        if ($defect->isEmpty()) {
            return response([
                'status' => false,
                'message' => 'Tidak ada data defect products',
            ], 404);
        }

        return response([
            'status' => true,
            'message' => 'List data defect products',
            'data' => $defect,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string',
            'pattern' => 'required|string',
            'serial' => 'required|string',
            'defect' => 'required|string',
            'area' => 'required|string',
            'mold' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'status' => 'required|string',
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->file('image')->storeAs('public/defect', $filename);

        $defect = \App\Models\Defect::create([
            'size' => $request->size,
            'pattern' => $request->pattern,
            'serial' => $request->serial,
            'defect' => $request->defect,
            'area' => $request->area,
            'mold' => $request->mold,
            'position' => $request->position,
            'image' => $filename,
            'status' => $request->status,
        ]);

        $size = $request->size;

        if($defect) {
            return response()->json([
                'success' => true,
                'message' => 'Product Defect Size ' . $size . ', berhasil dibuat dan disimpan',
                'data' => $defect,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product Defect Size ' . $size . ', gagal dibuat dan disimpan!',
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'size' => 'sometimes|required|string',
                'pattern' => 'sometimes|required|string',
                'serial' => 'sometimes|required|string',
                'defect' => 'sometimes|required|string',
                'area' => 'sometimes|required|string',
                'mold' => 'sometimes|required|string',
                'position' => 'sometimes|required|string',
                'image' => 'sometimes|image|mimes:png,jpg,jpeg',
                'status' => 'sometimes|required|string',
            ]);

            if($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json([
                    'success' => false,
                    'message' => $error,
                ], 422);
            } else {
                $defect = \App\Models\Defect::find($id);

                $defect->size = $request->size ?? $defect->size;
                $defect->pattern = $request->pattern ?? $defect->pattern;
                $defect->serial = $request->serial ?? $defect->serial;
                $defect->defect = $request->defect ?? $defect->defect;
                $defect->area = $request->area ?? $defect->area;
                $defect->mold = $request->mold ?? $defect->mold;
                $defect->position = $request->position ?? $defect->position;
                $defect->status = $request->status ?? $defect->status;

                // Jika ada file gambar baru yang diunggah, hapus gambar lama dan simpan gambar baru
                if ($request->image && $request->image->isValid() && $request->hasFile('image')) {
                    // Hapus gambar lama jika ada
                    if ($defect->image) {
                        Storage::delete('public/defect/' . $defect->image);
                    }

                    // Simpan gambar baru
                    $filename = time() . '.' . $request->image->extension();
                    $request->file('image')->storeAs('public/defect', $filename);
                    $defect->image = $filename;
                }

                $size = $defect->size;
                $defect->update();

                return response()->json([
                    'success' => true,
                    'message' => 'Data Product Defect Size ' . $size . ', berhasil diperbarui',
                    'data' => $defect,
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
            $defect = \App\Models\Defect::find($id);

            $size = $defect->size;

            if (!$defect) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Product Defect Size ' . $size . ', tidak ditemukan',
                ], 404);
            }

             if ($defect->image) {
                // Mengambil path dari URL gambar
                $imagePath = 'public/defect/' . $defect->image;

                // Menghapus file gambar dari storage
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }

            $defect->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Product Defect Size ' . $size . ' berhasil dihapus!',
                'data' => $defect,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message'=> 'Terjadi kesalahan saat menghapus defect: ' . $e->getMessage(),
            ], 422);
        }
    }
}