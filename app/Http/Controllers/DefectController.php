<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DefectController extends Controller
{

    //    'size',
    //     'pattern',
    //     'serial',
    //     'defect',
    //     'area',
    //     'mold',
    //     'position',
    //     'image',
    //     'status'
    public function index(Request $request)
    {
        // Mendapatkan semua data products
        $defects = DB::table('defects')
            ->when($request->input('defect'), function ($query, $defect) {
                return $query->where('defect', 'like', '%' . $defect . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        // Mengurutkan berdasarkan created_at secara menurun/desc

        return view('pages.defect.index', compact('defects'));
    }

    public function create()
    {
        return view('pages.defect.create');
    }

     public function store(Request $request)
    {
        $data = $request->all();

        // Simpan gambar dan dapatkan URL-nya
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/defect', $filename); // Simpan gambar di storage

            // simpan gambar dan dapatkan URL-nya
            // $imagePath = $request->file('image')->storeAs('public/products', $filename); // Simpan gambar di storage
            // $imageUrl = asset(str_replace('public', 'storage', $imagePath)); // Dapatkan URL gambar

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
        return view('pages.defect.edit', compact('defect'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $defect = \App\Models\Defect::findOrFail($id);

        // Menghapus gambar lama jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($defect->image) {
                // $oldImagePath = str_replace(asset('storage'), 'public', $product->image);
                $oldImagePath = 'public/defect/' . $defect->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            // Simpan gambar baru di storage
            $filename = time() . '.' . $request->image->extension();
            $request->file('image')->storeAs('public/defect', $filename);

            // $newImagePath = $request->file('image')->storeAs('public/products', $filename);
            // $newImageUrl = asset(str_replace('public', 'storage', $newImagePath));

            $data['image'] = $filename;
        } else {
            // Jika tidak ada gambar baru diunggah, gunakan gambar yang sudah ada
            $data['image'] = $defect->image;
        }

        $defect->update($data);
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully updated');
    }

    public function destroy($id)
    {
        $defect = \App\Models\Defect::findOrFail($id);

        // Menghapus gambar dari storage jika ada
        if ($defect->image) {
            // Mengambil path dari URL gambar
            // $imagePath = str_replace(asset('storage'), 'public', $product->image);
            $imagePath = 'public/defect/' . $defect->image;

            // Menghapus file gambar dari storage
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $defect->delete();
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully deleted');
    }
}
