<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStockCount = Product::where('quantity', '>', 0)
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->count();
        $outOfStockCount = Product::where('quantity', '<=', 0)->count();
        $attentionCount = Product::whereColumn('quantity', '<=', 'reorder_level')->count();
        $inStockCount = Product::whereColumn('quantity', '>', 'reorder_level')->count();

        $totalInventoryValue = Product::selectRaw('COALESCE(SUM(quantity * unit_price), 0) as total')
            ->value('total');

        $healthRate = $totalProducts > 0 ? round(($inStockCount / $totalProducts) * 100) : 0;

        $recentProducts = Product::latest()->take(5)->get();
        $alertProducts = Product::whereColumn('quantity', '<=', 'reorder_level')->get();

        $categorySummary = Product::select('category', DB::raw('SUM(quantity * unit_price) as total_value'))
            ->groupBy('category')
            ->get();

        $topProducts = Product::select('name', DB::raw('(quantity * unit_price) as total_value'))
            ->orderByDesc('total_value')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStockCount',
            'outOfStockCount',
            'attentionCount',
            'inStockCount',
            'totalInventoryValue',
            'healthRate',
            'recentProducts',
            'alertProducts',
            'categorySummary',
            'topProducts'
        ));
    }
}