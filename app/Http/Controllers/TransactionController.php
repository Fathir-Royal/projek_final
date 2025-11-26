<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Tampilkan daftar transaksi berdasarkan tipe (in/out)
    public function index($type)
    {
        $transactions = Transaction::where('type', $type)->orderBy('created_at','desc')->get();
        $products = Product::all();

        return view('transactions.index', compact('transactions', 'products', 'type'));
    }

    // Simpan transaksi baru barang masuk/keluar
    public function store(Request $request, $type)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        // Generate nomor transaksi otomatis
        $transactionNumber = 'TX-' . strtoupper(uniqid());

        // Insert transaksi utama
        $tx = Transaction::create([
            'transaction_number' => $transactionNumber,
            'type' => $type,
            'created_by' => Auth::id(),
            'status' => 'pending',
            'notes' => $request->notes ?? null
        ]);

        // Insert item transaksi ke tabel detail
        foreach ($request->items as $item) {
            $tx->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity']
            ]);
        }

        return back()->with('success', 'Transaksi berhasil dibuat dan menunggu persetujuan');
    }

    // Manager meng-approve transaksi
    public function approve($id)
    {
        $tx = Transaction::with('items.product')->findOrFail($id);

        if ($tx->status !== 'pending') {
            return back()->withErrors(['msg' => 'Transaksi sudah diproses sebelumnya']);
        }

        // Update stok sesuai tipe transaksi
        foreach ($tx->items as $item) {
            $product = $item->product;

            if ($tx->type == 'in') {
                // Barang masuk -> stok bertambah
                $product->stock_current += $item->quantity;
            } else {
                // Barang keluar -> stok berkurang (cek stok cukup)
                if ($product->stock_current < $item->quantity) {
                    return back()->withErrors(["msg" => "Stok produk $product->name tidak mencukupi"]);
                }
                $product->stock_current -= $item->quantity;
            }

            $product->save();
        }

        // Update status transaksi menjadi approved
        $tx->status = 'approved';
        $tx->approved_by = Auth::id();
        $tx->save();

        return back()->with('success', 'Transaksi berhasil disetujui dan stok diperbarui');
    }
}
