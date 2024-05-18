<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = \App\Models\Product::orderBy('id', 'desc')->get();

        if(!$product) {
            return response([
                'status' => false,
                'message' => 'Tidak ada data products',
                'data' => [],
            ], 404);
        }

        return response([
            'status' => true,
            'message' => 'List data products',
            'data' => $product,
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
        //  'size',
        // 'pattern',
        // 'item_code',
        // 'marking_line',
        $request->validate([
            'size' => 'required|string',
            'pattern' => 'required|string',
            'item_code' => 'required|string',
            'marking_line' => 'required|string',
        ]);

        $product = \App\Models\Product::create([
            'size' => $request->size,
            'pattern' => $request->pattern,
            'item_code' => $request->item_code,
            'marking_line' => $request->marking_line,
        ]);

        if($product) {
            return response()->json([
                'success' => true,
                'message' => 'product created successfully',
                'data' => $product,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'product failed to created',
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
                'size' => 'sometimes|required|string',
                'pattern' => 'sometimes|required|string',
                'item_code' => 'sometimes|required|string',
                'marking_line' => 'sometimes|required|string',
            ]);

            if($validator->fails()) {
                $error = $validator->errors()->all()[0];
                return response()->json([
                    'success' => false,
                    'message' => $error,
                ], 422);
            } else {
                $product = \App\Models\Product::find($id);

                $product->size = $request->size ?? $product->size;
                $product->pattern = $request->pattern ?? $product->pattern;
                $product->item_code = $request->item_code ?? $product->item_code;
                $product->marking_line = $request->marking_line ?? $product->marking_line;



                $product->update();

                return response()->json([
                    'success' => true,
                    'message' => 'product berhasil diperbarui',
                    'data' => $product,
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
            $product = \App\Models\Product::find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'product tidak ditemukan',
                ], 404);
            }

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product berhasil dihapus',
                'data' => $product,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message'=> 'Terjadi kesalahan saat menghapus Product: ' . $e->getMessage(),
            ], 422);
        }
    }
}