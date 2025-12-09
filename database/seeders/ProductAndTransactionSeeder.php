<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\RestockOrder;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductAndTransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kita menjalankan semua ini dalam satu transaksi DB yang aman
        DB::transaction(function () {
            
            // --- 1. BUAT KATEGORI & TENTUKAN PATH GAMBAR DUMMY ---
            $catEngine = Category::create(['name' => 'Suku Cadang Mesin', 'description' => 'Komponen yang berhubungan dengan kinerja mesin.', 'image_path' => 'category_images/engine_motor.png']);
            $catBrake = Category::create(['name' => 'Sistem Pengereman', 'description' => 'Komponen untuk sistem pengereman depan dan belakang.', 'image_path' => 'category_images/brake_motor.png']);
            $catBody = Category::create(['name' => 'Aksesoris & Bodi', 'description' => 'Komponen eksterior dan aksesori motor.', 'image_path' => 'category_images/body_motor.png']);

            // --- 2. AMBIL USER UTAMA (Asumsi sudah dibuat di DatabaseSeeder) ---
            $manager = User::where('role', 'manager')->first();
            $staff = User::where('role', 'staff')->first();
            $supplierDistributor = User::where('name', 'Bengkel Sahabat')->first();

            // --- 3. BUAT PRODUK UTAMA (Menguji 3 Status Stok) ---
            
            $prodSparkPlug = Product::create([
                'sku' => 'BGS-I01', 'name' => 'Busi Iridium Racing', 'category_id' => $catEngine->id,
                'description' => 'Busi Iridium untuk performa tinggi, umur pakai lebih lama.', 'purchase_price' => 50000.00, 'sale_price' => 95000.00,
                'stock_current' => 2, 'stock_minimum' => 10, 'unit' => 'pcs', 'storage_location' => 'RACK-E-01',
                'image_path' => 'product_images/busi.png' 
            ]);

            $prodBrakePad = Product::create([
                'sku' => 'BRP-S07', 'name' => 'Kampas Rem Depan Sport', 'category_id' => $catBrake->id,
                'description' => 'Kampas rem semi-metalik untuk pengereman optimal.', 'purchase_price' => 25000.00, 'sale_price' => 45000.00,
                'stock_current' => 80, 'stock_minimum' => 20, 'unit' => 'unit', 'storage_location' => 'CAB-A-05',
                'image_path' => 'product_images/kampas_rem.png' 
            ]);

            $prodExhaust = Product::create([
                'sku' => 'KNP-RCS-03', 'name' => 'Knalpot Racing Stainless', 'category_id' => $catBody->id,
                'description' => 'Knalpot full system berbahan stainless steel.', 'purchase_price' => 300000.00, 'sale_price' => 550000.00,
                'stock_current' => 0, 'stock_minimum' => 5, 'unit' => 'unit', 'storage_location' => 'BIN-F-12',
                'image_path' => 'product_images/knalpot.png' 
            ]);

            // --- 4. BUAT RESTOCK ORDER (PO) ---
            $po1 = RestockOrder::create([
                'po_number' => 'PO-' . Str::random(10), 'supplier_id' => $supplierDistributor->id,
                'order_date' => now()->subDays(5), 'expected_delivery_date' => now()->addDays(2),
                'status' => 'confirmed', 'created_by_user_id' => $manager->id, 'notes' => 'Urgent priority shipment.'
            ]);
            // Attach items to PO-1
            $po1->products()->attach([
                $prodSparkPlug->id => ['quantity' => 20],
                $prodBrakePad->id => ['quantity' => 50],
            ]);


            // --- 5. BUAT TRANSAKSI (History) ---
            
            // TRX-1: Transaksi Masuk (APPROVED - Stock bertambah 10)
            $trx1 = Transaction::create([
                'transaction_number' => 'TRX-' . Str::random(10), 'type' => 'incoming',
                'transaction_date' => now()->subDays(3), 'status' => 'approved', 'supplier_id' => $supplierDistributor->id,
                'created_by_user_id' => $staff->id, 'approved_by_user_id' => $manager->id, 'notes' => 'Initial stock deposit.'
            ]);
            // Update stock + attach pivot
            $prodBrakePad->increment('stock_current', 10);
            $trx1->products()->attach([$prodBrakePad->id => ['quantity' => 10]]);


            // TRX-2: Transaksi Keluar (PENDING - Perlu Approval Manager)
            $trx2 = Transaction::create([
                'transaction_number' => 'TRX-' . Str::random(10), 'type' => 'outgoing',
                'transaction_date' => now()->subDays(1), 'status' => 'pending', 'customer_name' => 'Bengkel Rizky',
                'created_by_user_id' => $staff->id, 'notes' => 'Spare-Parts cadangan.'
            ]);
            // Attach items to PENDING transaction
            $trx2->products()->attach([
                $prodSparkPlug->id => ['quantity' => 1] 
            ]);
        });
    }
}