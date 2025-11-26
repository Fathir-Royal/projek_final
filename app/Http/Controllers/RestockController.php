<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\RestockOrder;
use App\Models\RestockOrderItem;
use Illuminate\Support\Facades\Auth;

class RestockController extends Controller
{
    // Manager: tampilkan semua PO
    public function index()
    {
        $orders = RestockOrder::with('supplier', 'items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('restocks.index', compact('orders'));
    }

    // Manager: form pembuatan PO
    public function create()
    {
        $products = Product::all();
        $suppliers = User::where('role', 'supplier')->where('is_approved', true)->get();
        return view('restocks.create', compact('products', 'suppliers'));
    }

    // Manager: simpan PO baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:users,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $poNumber = "PO-" . strtoupper(uniqid());

        $po = RestockOrder::create([
            'po_number' => $poNumber,
            'supplier_id' => $request->supplier_id,
            'manager_id' => Auth::id(),
            'order_date' => now(),
            'status' => 'pending',
            'notes' => $request->notes ?? null
        ]);

        foreach ($request->items as $item) {
            $po->items()->create($item);
        }

        return redirect()->route('restocks.index')->with('success', 'Purchase Order berhasil dibuat');
    }

    // Supplier: lihat PO miliknya
    public function indexForSupplier()
    {
        $orders = RestockOrder::where('supplier_id', Auth::id())->get();
        return view('restocks.supplier_index', compact('orders'));
    }

    // Supplier: konfirmasi PO
    public function confirm($id)
    {
        $order = RestockOrder::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();

        return back()->with('success', 'PO telah dikonfirmasi supplier');
    }

    // Manager: update status pengiriman
    public function ship($id)
    {
        $order = RestockOrder::findOrFail($id);
        $order->status = 'in_transit';
        $order->save();

        return back()->with('success', 'Status PO diubah menjadi: Dalam Pengiriman');
    }

    // Staff: menerima barang & update stok
    public function receive($id)
    {
        $order = RestockOrder::with('items.product')->findOrFail($id);

        foreach ($order->items as $item) {
            $prod = $item->product;
            $prod->stock_current += $item->quantity;
            $prod->save();
        }

        $order->status = 'received';
        $order->save();

        return back()->with('success', 'Barang diterima dan stok telah diperbarui');
    }
}
