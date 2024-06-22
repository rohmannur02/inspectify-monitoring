<?php

namespace App\Http\Controllers;

use App\Models\Defect;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\CustomizeDefectsExport;
use App\Exports\DefectsExport;
use Maatwebsite\Excel\Facades\Excel;

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

        Defect::create($data);
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully created');
    }

    public function edit($id)
    {
        $defect = Defect::findOrFail($id);
        $sizes = Product::select('size')->distinct()->get();

        // Memuat semua data products
        $products = Product::all();

        return view('pages.defect.edit', compact('defect', 'sizes', 'products',));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $defect = Defect::findOrFail($id);

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
        $defect = Defect::findOrFail($id);

        if ($defect->image) {
            $imagePath = 'public/defect/' . $defect->image;

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }

        $defect->delete();
        return redirect()->route('defect.index')->with('success', 'Product Defect successfully deleted');
    }

    public function reportByDefect(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $defects = DB::table('defects')
            // Kondisi dimana ketika ada StartDate dan EndDate yang diinput akan menghasilkan data yang sesuai dengan range tanggal tersebut
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            }, function ($query) {
                // Kondisi default mengembalikan seluruh data jika tidak ada start_date dan end_date
                return $query;
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.report.report_by_defect', compact('defects', 'startDate', 'endDate'));
    }

    // Jika sidebar Customize Data Defect di klik akan menampilkan halaman viewCustomizeReportDefects dengan membawa data Products
    public function viewCustomizeReportDefects()
    {
        // Mendapatkan semua ukuran yang unik dari tabel Products
        $sizes = Product::select('size')->distinct()->get();

        // Memuat semua data products
        $products = Product::all();

        return view('pages.report.customize_defect', compact('sizes', 'products'));
    }

    // Jika tombol Generate Report di klik akan menampilkan data sesuai dengan input yang diberikan oleh user pada halaman customize_defect
    public function generateCustomizeReport(Request $request)
    {
        // Mendapatkan semua ukuran yang unik dari tabel Products
        $sizes = Product::select('size')->distinct()->get();

        // Memuat semua data products
        $products = Product::all();

        // Mengambil input dari user
        $size = $request->input('size');
        $pattern = $request->input('pattern');
        $itemCode = $request->input('item_code');
        $defect = $request->input('defect');

        // Kondisi 1: Ketika hanya ada input defect
        if (empty($size) && empty($pattern) && empty($itemCode) && !empty($defect)) {
            // Menghitung total qty berdasarkan defect
            $headerTable = "Data with Specific Defect: $defect, and All Size";
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('defect', $defect)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi 2: Ketika semua field diisi oleh user
        } elseif (!empty($size) && !empty($pattern) && !empty($itemCode) && !empty($defect)) {
            // Menghitung total qty berdasarkan semua input field
            $headerTable = "Data with Specific Size: $size, Pattern: $pattern, Item Code: $itemCode, and Defect: $defect";
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
            $headerTable = "Data with Specific Size: $size, Pattern: $pattern, Item Code: $itemCode, and All Defect";
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('size', $size)
                ->where('pattern', $pattern)
                ->where('item_code', $itemCode)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi default: Tidak ada input yang diberikan variable $defects menjadi kosong
        } else {
            $defects = collect();
        }

        return view('pages.report.customize_defect', compact('defects', 'sizes', 'products', 'headerTable'));
    }

    public function exportExcelCustomizeDefect(Request $request)
    {
        // Mengambil input dari user
        $size = $request->input('size');
        $pattern = $request->input('pattern');
        $itemCode = $request->input('item_code');
        $defect = $request->input('defect');

        // Kondisi 1: Ketika hanya ada input defect
        if (empty($size) && empty($pattern) && empty($itemCode) && !empty($defect)) {
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('defect', $defect)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi 2: Ketika semua field diisi oleh user
        } elseif (!empty($size) && !empty($pattern) && !empty($pattern) && !empty($defect)) {
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect', DB::raw('count(*) as qty'))
                ->where('size', $size)
                ->where('pattern', $pattern)
                ->where('item_code', $itemCode)
                ->where('defect', $defect)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi 3: Ketika hanya ada input size, pattern, dan item_code tanpa defect
        } elseif (!empty($size) && !empty($pattern) && !empty($pattern) && empty($defect)) {
            $defects = DB::table('defects')
                ->select('size', 'pattern', 'item_code', 'defect',  DB::raw('count(*) as qty'))
                ->where('size', $size)
                ->where('pattern', $pattern)
                ->where('item_code', $itemCode)
                ->groupBy('size', 'pattern', 'item_code', 'defect')
                ->get();

        // Kondisi default: Tidak ada input yang diberikan variable $defects menjadi kosong
        } else {
            $defects = collect();
        }

        // Ekspor ke Excel menggunakan class DefectsExport
        return Excel::download(new CustomizeDefectsExport($defects), 'customize-defects.xlsx');
    }

    public function exportExcelDefects(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $defects = DB::table('defects')
            // Kondisi dimana ketika ada StartDate dan EndDate yang diinput akan menghasilkan data yang sesuai dengan range tanggal tersebut
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            }, function ($query) {
                // Kondisi default mengembalikan seluruh data jika tidak ada start_date dan end_date
                return $query;
            })
            ->select('author', 'size', 'pattern', 'item_code', 'serial', 'defect', 'area', 'mold', 'position', 'status', 'created_at')
            ->get();

        // Ekspor ke Excel menggunakan class DefectsExport
        return Excel::download(new DefectsExport($defects), 'defects.xlsx');
    }
}
