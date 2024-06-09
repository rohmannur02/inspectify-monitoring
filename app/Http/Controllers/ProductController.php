<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan semua data products
        $products = DB::table('products')
            ->when($request->input('size'), function ($query, $size) {
                return $query->where('size', 'like', '%' . $size . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        return view('pages.product.create');
    }

     public function store(Request $request)
    {
        $data = $request->all();

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'product successfully created');
    }

    public function edit($id)
    {
        $products = \App\Models\Product::findOrFail($id);
        return view('pages.product.edit', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);

        $product->update($data);
        return redirect()->route('product.index')->with('success', 'product successfully updated');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        return redirect()->route('product.index')->with('success', 'product successfully deleted');
    }
}
