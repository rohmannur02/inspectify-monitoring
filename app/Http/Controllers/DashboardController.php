<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Defect;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $totalUsers = DB::table('users')->count();
        $totalProductions = DB::table('result_productions')->count();
        $totalDefects = DB::table('defects')->count();

        $totalRepair = DB::table('defects')->where('status', 'repair')->count();
        $totalScrap = DB::table('defects')->where('status', 'scrap')->count();

        $trendDefects = Defect::select('size', 'defect', DB::raw('COUNT(*) as total'))
            ->groupBy('size', 'defect')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('pages.dashboard', compact(
            'totalUsers',
            'totalProductions',
            'totalDefects',
            'trendDefects',
            'totalRepair',
            'totalScrap',
        ));
    }
}