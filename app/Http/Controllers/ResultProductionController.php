<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ResultProduction;
use Illuminate\Support\Facades\Storage;

class ResultProductionController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan semua data result productions dengan pagination
        $productions = ResultProduction::when($request->input('schedule'), function ($query, $schedule) {
                return $query->where('schedule', 'like', '%' . $schedule . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('pages.production.index', compact('productions'));
    }

    public function create()
    {
        // Mendapatkan semua ukuran yang unik dari tabel Products
        $sizes = Product::distinct()->pluck('size');

        // Memuat semua data products
        $products = Product::all();

        return view('pages.production.create', compact('sizes', 'products'));
    }

     public function store(Request $request)
    {
        $request->validate([
            // Validasi data input sesuai kebutuhan
        ]);

        ResultProduction::create($request->all());

        return redirect()->route('production.index')->with('success', 'Production successfully created');
    }

    public function edit($id)
    {
        $production = ResultProduction::findOrFail($id);
        $sizes = Product::distinct()->pluck('size');
        $products = Product::all();

        return view('pages.production.edit', compact('production', 'sizes', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi data input sesuai kebutuhan
        ]);

        $production = ResultProduction::findOrFail($id);
        $production->update($request->all());

        return redirect()->route('production.index')->with('success', 'Production successfully updated');
    }

    public function destroy($id)
    {
        $production = ResultProduction::findOrFail($id);
        $production->delete();

        return redirect()->route('production.index')->with('success', 'Production successfully deleted');
    }
}
