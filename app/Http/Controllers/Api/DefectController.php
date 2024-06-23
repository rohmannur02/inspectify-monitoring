<?php

namespace App\Http\Controllers\Api;

use App\Models\Defect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class DefectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Defect::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('size', 'LIKE', "%{$search}%")
                ->orWhere('pattern', 'LIKE', "%{$search}%")
                ->orWhere('defect', 'LIKE', "%{$search}%")
                ->orWhere('author', 'LIKE', "%{$search}%")
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
            'item_code' => 'required|string',
            'serial' => 'required|string',
            'defect' => 'required|string',
            'area' => 'required|string',
            'mold' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'status' => 'required|string',
            'author' => 'required|string',
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->file('image')->storeAs('public/defect', $filename);

        $defect = Defect::create([
            'size' => $request->size,
            'pattern' => $request->pattern,
            'item_code' => $request->item_code,
            'serial' => $request->serial,
            'defect' => $request->defect,
            'area' => $request->area,
            'mold' => $request->mold,
            'position' => $request->position,
            'image' => $filename,
            'status' => $request->status,
            'author' => $request->author,
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
                'item_code' => 'sometimes|required|string',
                'serial' => 'sometimes|required|string',
                'defect' => 'sometimes|required|string',
                'area' => 'sometimes|required|string',
                'mold' => 'sometimes|required|string',
                'position' => 'sometimes|required|string',
                'image' => 'sometimes|image|mimes:png,jpg,jpeg',
                'status' => 'sometimes|required|string',
                'author' => 'sometimes|required|string',
            ]);

            if($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json([
                    'success' => false,
                    'message' => $error,
                ], 422);
            } else {
                $defect = Defect::find($id);

                $defect->size = $request->size ?? $defect->size;
                $defect->pattern = $request->pattern ?? $defect->pattern;
                $defect->item_code = $request->item_code ?? $defect->item_code;
                $defect->serial = $request->serial ?? $defect->serial;
                $defect->defect = $request->defect ?? $defect->defect;
                $defect->area = $request->area ?? $defect->area;
                $defect->mold = $request->mold ?? $defect->mold;
                $defect->position = $request->position ?? $defect->position;
                $defect->status = $request->status ?? $defect->status;
                $defect->author = $request->author ?? $defect->author;

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
            $defect = Defect::find($id);

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

    public function getTrenDefectTotalProductionAndTotalDefect()
    {
        $trendDefects = Defect::select('size', 'defect', DB::raw('COUNT(*) as total'))
            ->groupBy('size', 'defect')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $totalRepair = Defect::where('status', 'repair')->count();
        $totalScrap = Defect::where('status', 'scrap')->count();
        $totalProductions = DB::table('result_productions')->count();
        $totalDefects = DB::table('defects')->count();

        return response()->json([
            'status' => true,
            'message' => 'Total counts for repair and scrap status',
            'data' => [
                'total_production' => $totalProductions,
                'total_defect' => $totalDefects,
                'repair' => $totalRepair,
                'scrap' => $totalScrap,
                'tren_defects' => $trendDefects,
            ],
        ], 200);
    }

    public function reportByDefectApi(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Konversi tanggal input ke objek Carbon untuk memudahkan pemrosesan tanggal
        $startDateCarbon = $startDate ? Carbon::createFromFormat('Y-m-d', $startDate) : null;
        $endDateCarbon = $endDate ? Carbon::createFromFormat('Y-m-d', $endDate) : null;

        $defects = DB::table('defects')
            // Kondisi dimana ketika ada StartDate dan EndDate yang diinput akan menghasilkan data yang sesuai dengan range tanggal tersebut
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            }, function ($query) {
                // Kondisi default mengembalikan seluruh data jika tidak ada start_date dan end_date
                return $query;
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if ($startDate && $endDate) {
            $formattedStartDate = $startDateCarbon->format('d-m-Y');
            $formattedEndDate = $endDateCarbon->format('d-m-Y');

            $message = "Laporan data defect products dari tanggal $formattedStartDate sampai $formattedEndDate";
        } else {
            $message = "Laporan seluruh data defect products";
        }

        if ($defects->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data defect products yang ditemukan untuk filter yang diberikan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $defects,
        ], 200);
    }

    public function generateCustomizeReportApi(Request $request)
    {
        // Mengambil input dari user
        $size = $request->input('size');
        $pattern = $request->input('pattern');
        $itemCode = $request->input('item_code');
        $defect = $request->input('defect');

        // Kondisi 1: Ketika hanya ada input defect
        if (empty($size) && empty($pattern) && empty($itemCode) && !empty($defect)) {
            // Menghitung total qty berdasarkan defect
            $message = "Data with Specific Defect: $defect, and All Size";
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('defect', $defect)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi 2: Ketika semua field diisi oleh user
        } elseif (!empty($size) && !empty($pattern) && !empty($itemCode) && !empty($defect)) {
            // Menghitung total qty berdasarkan semua input field
            $message = "Data with Specific Size: $size, Pattern: $pattern, Item Code: $itemCode, and Defect: $defect";
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('size', $size)
                ->where('pattern', $pattern)
                ->where('item_code', $itemCode)
                ->where('defect', $defect)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi 3: Ketika hanya ada input size, pattern, dan item_code tanpa defect
        } elseif (!empty($size) && !empty($pattern) && empty($defect)) {
            // Menghitung total qty berdasarkan size, pattern, dan item_code
            $message = "Data with Specific Size: $size, Pattern: $pattern, Item Code: $itemCode, and All Defect";
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('size', $size)
                ->where('pattern', $pattern)
                ->where('item_code', $itemCode)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi default: Tidak ada input yang diberikan, variable $defects menjadi kosong
        } else {
            $defects = collect();
            $message = "Tidak ada filter yang diterapkan";
        }

        if ($defects->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak ada data defect products yang ditemukan untuk filter yang diberikan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $defects,
        ], 200);
    }

}
