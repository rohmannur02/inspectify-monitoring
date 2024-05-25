<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DefectController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan semua data products
        $defects = DB::table('defects')
            ->when($request->input('defect'), function ($query, $defect) {
                return $query->where('defect', 'like', '%' . $defect . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.defect.index', compact('defects'));
    }

    public function create()
    {
         // Mendapatkan semua ukuran yang unik dari tabel Products
        $sizes = Product::select('size')->distinct()->get();

        // Memuat semua data products
        $products = Product::all();

        return view('pages.defect.create', compact('sizes', 'products'));
    }

     public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/defect', $filename);

            $data['image'] = $filename;
        } else {
            $data['image'] = "";
        }

        \App\Models\Defect::create($data);
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully created');
    }

    public function edit($id)
    {
        $defect = \App\Models\Defect::findOrFail($id);
        $sizes = Product::select('size')->distinct()->get();

        // Memuat semua data products
        $products = Product::all();

        return view('pages.defect.edit', compact('defect', 'sizes', 'products',));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $defect = \App\Models\Defect::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($defect->image) {
                $oldImagePath = 'public/defect/' . $defect->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $filename = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/defect', $filename);

            $data['image'] = $filename;
        } else {
            $data['image'] = $defect->image;
        }

        $defect->update($data);
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully updated');
    }

    public function destroy($id)
    {
        $defect = \App\Models\Defect::findOrFail($id);

        if ($defect->image) {
            $imagePath = 'public/defect/' . $defect->image;

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $defect->delete();
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully deleted');
    }
}