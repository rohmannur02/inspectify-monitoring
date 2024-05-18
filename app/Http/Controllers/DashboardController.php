<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ResultProduction;
use App\Models\Orders;
use Carbon\CarbonImmutable;

class DashboardController extends Controller
{
    public function index(Request $request) {
        // Ambil data order terbaru
        $latestProductions = ResultProduction::latest()->take(5)->get();

        // Menghitung total pengguna, produk, transaksi, dan pendapatan
        $totalUsers = DB::table('users')->count();
        $totalProductions = DB::table('result_productions')->count();
        $totalDefects = DB::table('defects')->count();
        // $totalIncome = DB::table('orders')->sum('grand_total_price');

        // Mengambil data transaksi dari database
        // $transactionData = DB::table('orders')
        //                     ->select(DB::raw('DATE(transaction_time) as date'), DB::raw('SUM(grand_total_price) as total_sales'))
        //                     ->groupBy('date')
        //                     ->get();

        // // Mendapatkan array labels dan data untuk grafik
        // $labels = $transactionData->pluck('date')->toArray();
        // $totalSales = $transactionData->pluck('total_sales')->toArray();

        // $now = CarbonImmutable::now()->tz('Asia/Jakarta');
        // // TANGGAL HARI INI & KEMARIN
        // $today = $now->toDateString();
        // $yesterday = Carbon::yesterday()->toDateString();
        // // TANGGAL AWAL MINGGU INI & TANGGAL AKHIR MINGGU INI
        // $weekStart = $now->startOfWeek()->format('Y-m-d H:i');
        // $weekEnd = $now->endOfWeek()->format('Y-m-d H:i');
        // // TANGGAL AWAL BULAN INI & TANGGAL AKHIR BULAN INI
        // $monthStart = $now->startOfMonth()->format('Y-m-d H:i');
        // $monthEnd = $now->endOfMonth()->format('Y-m-d H:i');
        // // TANGGAL AWAL TAHUN INI & TANGGAL AKHIR TAHUN INI
        // $yearStart = $now->startOfYear()->format('Y-m-d H:i');
        // $yearEnd = $now->endOfYear()->format('Y-m-d H:i');

        // // Ambil tanggal awal minggu lalu & TANGGAL AKHIR MINGGU LALU
        // $lastWeekStart = $now->subWeek()->startOfWeek()->format('Y-m-d H:i');
        // $lastWeekEnd = $now->subWeek()->endOfWeek()->format('Y-m-d H:i');
        // // Ambil tanggal awal bulan lalu & TANGGAL AKHIR BULAN LALU
        // $lastMonthStart = $now->subMonth()->startOfMonth()->format('Y-m-d H:i');
        // $lastMonthEnd = $now->subMonth()->endOfMonth()->format('Y-m-d H:i');
        // // Ambil tanggal awal tahun lalu & TANGGAL AKHIR TAHUN LALU
        // $lastYearStart = $now->subYear()->startOfYear()->format('Y-m-d H:i');
        // $lastYearEnd = $now->subYear()->endOfYear()->format('Y-m-d H:i');


        // /* CALCULATE INCOME TODAY, WEEKLY, MONTHLY, AND YEARLY */
        // // Hitung total penjualan untuk hari ini
        // $todaySales = (int) $this->calculateTotalSalesForDate($today);
        // // Hitung total penjualan untuk 1 minggu ini
        // $weekSales = (int) $this->calculateTotalSalesForDateRange($weekStart, $weekEnd);
        // // Hitung total penjualan untuk 1 bulan ini
        // $monthSales = (int) $this->calculateTotalSalesForDateRange($monthStart, $monthEnd);
        // // Hitung total penjualan untuk 1 tahun ini
        // $yearSales = (int) $this->calculateTotalSalesForDateRange($yearStart, $yearEnd);


        // /* CALCULATE INCOME YESTERDAY, LAST WEEK, LAST MONTH, AND LAST YEAR */
        // // Hitung total penjualan kemarin
        // $yesterdaySales = (int) $this->calculateTotalSalesForDate($yesterday);
        // // Hitung total penjualan untuk minggu lalu
        // $lastWeekSales = (int) $this->calculateTotalSalesForDateRange($lastWeekStart, $lastWeekEnd);
        // // Hitung total penjualan untuk bulan lalu
        // $lastMonthSales = (int) $this->calculateTotalSalesForDateRange($lastMonthStart, $lastMonthEnd);
        // // Hitung total penjualan untuk tahun lalu
        // $lastYearSales = (int) $this->calculateTotalSalesForDateRange($lastYearStart, $lastYearEnd);


        // $todayVsYesterday = $this->calculateSalesPercentage($yesterdaySales, $todaySales);
        // $weekVsLastWeek = $this->calculateSalesPercentage($lastWeekSales, $weekSales);
        // $monthVsLastMonth = $this->calculateSalesPercentage($lastMonthSales, $monthSales);
        // $yearVsLastYear = $this->calculateSalesPercentage($lastYearSales, $yearSales);

        //  // Mengelompokkan data transaksi ke dalam mingguan (week), bulanan (month), dan tahunan (year)
        // $weeklyData = $this->groupTransactionData($transactionData, 'week');
        // $monthlyData = $this->groupTransactionData($transactionData, 'month');
        // $yearlyData = $this->groupTransactionData($transactionData, 'year');
        // $allData = $this->groupTransactionData($transactionData, 'all');

        return view('pages.dashboard', compact(
            'latestProductions',
            'totalUsers',
            'totalProductions',
            'totalDefects',
            // 'totalIncome',
            // 'totalSales',
            // 'transactionData',
            // 'labels',
            // 'todaySales',
            // 'yesterdaySales',
            // 'weekSales',
            // 'monthSales',
            // 'yearSales',
            // 'todayVsYesterday',
            // 'weekVsLastWeek',
            // 'monthVsLastMonth',
            // 'yearVsLastYear',
            // 'weeklyData',
            // 'monthlyData',
            // 'yearlyData',
            // 'allData',
        ));
    }

    private function calculateTotalSalesForDate($date)
    {
        return Orders::whereDate('transaction_time', $date)->sum('grand_total_price');
    }

    private function calculateTotalSalesForDateRange($startDate, $endDate)
    {
        return Orders::whereBetween('transaction_time', [$startDate, $endDate])->sum('grand_total_price');
    }

    private function calculateSalesPercentage($previousSales, $currentSales)
    {
        // Menghitung persentase perubahan penjualan
        if ($previousSales == 0 && $currentSales == 0) {
            return 0; // Kembalikan 0 jika tidak ada penjualan sama sekali
        } elseif ($previousSales == 0) {
            return 100; // Kembalikan 100 jika tidak ada penjualan di tahun lalu, bulan lalu, atau kemarin
        }

        // Menghitung persentase perubahan penjualan
        $percentageChange = (($currentSales - $previousSales) / abs($previousSales)) * 100;

        return round($percentageChange, 2);
    }

    private function groupTransactionData($transactionData, $grouping)
    {
        $groupedData = [];

        switch ($grouping) {
            case 'week':
                $groupedData = $transactionData->groupBy(function ($item) {
                    $date = Carbon::createFromFormat('Y-m-d', $item->date);
                    return $date->startOfWeek()->toDateString() . ' - ' . $date->endOfWeek()->toDateString();
                })->map(function ($groupedItems, $weekDateRange) {
                    $totalSales = $groupedItems->sum('total_sales');
                    return ['label' => $weekDateRange, 'total_sales' => $totalSales];
                })->values()->toArray();
                break;

            case 'month':
                $groupedData = $transactionData->groupBy(function ($item) {
                    return Carbon::createFromFormat('Y-m-d', $item->date)->startOfMonth()->format('Y-m');
                })->map(function ($groupedItems, $monthStartDate) {
                    $totalSales = $groupedItems->sum('total_sales');
                    return ['label' => Carbon::parse($monthStartDate)->format('F Y'), 'total_sales' => $totalSales];
                })->values()->toArray();
                break;

            case 'year':
                $groupedData = $transactionData->groupBy(function ($item) {
                    return Carbon::createFromFormat('Y-m-d', $item->date)->startOfYear()->format('Y');
                })->map(function ($groupedItems, $yearStartDate) {
                    $totalSales = $groupedItems->sum('total_sales');
                    return ['label' => $yearStartDate, 'total_sales' => $totalSales];
                })->values()->toArray();
                break;

            case 'all':
                $groupedData = $transactionData->map(function ($item) {
                    $date = Carbon::createFromFormat('Y-m-d', $item->date);
                    return ['label' => $date->isoFormat("dddd, DD MMMM YYYY"), 'total_sales' => $item->total_sales];
                })->values()->toArray();
                break;

            default:
            break;
        }
        return $groupedData;
    }
}