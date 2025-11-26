<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\RestockOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Data umum untuk semua role
        $lowStockProducts = Product::whereColumn('stock_current', '<=', 'stock_min')->get();

        // Role admin & manager: full analytics
        if ($user->role == 'admin' || $user->role == 'manager') {

            $totalProducts = Product::count();
            $totalTransactions = Transaction::count();
            $totalPendingRestock = RestockOrder::where('status','pending')->count();

            return view('dashboard', [
                'user' => $user,
                'lowStockProducts' => $lowStockProducts,
                'totalProducts' => $totalProducts,
                'totalTransactions' => $totalTransactions,
                'totalPendingRestock' => $totalPendingRestock
            ]);
        }

        // Role staff
        if ($user->role == 'staff') {

            // Hanya melihat transaksi pending
            $pendingTransactions = Transaction::where('status','pending')->get();

            return view('dashboard', [
                'user' => $user,
                'lowStockProducts' => $lowStockProducts,
                'pendingTransactions' => $pendingTransactions
            ]);
        }

        // Role supplier
        if ($user->role == 'supplier') {

            // Jumlah PO menunggu konfirmasi
            $pendingPO = RestockOrder::where('supplier_id', $user->id)
                        ->where('status','pending')
                        ->count();

            return view('dashboard', [
                'user' => $user,
                'pendingPO' => $pendingPO
            ]);
        }

        // Default fallback
        return view('dashboard');
    }
}
