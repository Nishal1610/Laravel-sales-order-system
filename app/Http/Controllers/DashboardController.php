<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\SalesOrder;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
    {
        $totalSales = SalesOrder::where('status', 'confirmed')->sum('total_amount');
        $totalOrders = SalesOrder::count();
        $lowStockProducts = Product::where('quantity', '<', 5)->get(); // You can change threshold

        return view('dashboard', compact('totalSales', 'totalOrders', 'lowStockProducts'));
    }
}
