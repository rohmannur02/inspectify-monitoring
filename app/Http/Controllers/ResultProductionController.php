<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResultProductionController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan semua data products
        $productions = DB::table('result_productions')
            ->when($request->input('schedule'), function ($query, $schedule) {
                return $query->where('schedule', 'like', '%' . $schedule . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.production.index', compact('productions'));
    }

    public function create()
    {
        return view('pages.production.create');
    }

     public function store(Request $request)
    {
        $data = $request->all();

        \App\Models\ResultProduction::create($data);

        return redirect()->route('production.index')->with('success', 'Production successfully created');
    }

    public function edit($id)
    {
        $productions = \App\Models\ResultProduction::findOrFail($id);
        return view('pages.production.edit', compact('productions'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $production = \App\Models\ResultProduction::findOrFail($id);

        $production->update($data);
        return redirect()->route('production.index')->with('success', 'production successfully updated');
    }

    public function destroy($id)
    {
        $production = \App\Models\ResultProduction::findOrFail($id);

        $production->delete();
        return redirect()->route('production.index')->with('success', 'production successfully deleted');
    }
}