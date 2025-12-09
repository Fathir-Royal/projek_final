# MOTORMAX WMS
**Workshop Management System - Khusus Bengkel Motor Modern**

Sistem manajemen gudang & sparepart berbasis web yang dirancang **khusus untuk bengkel motor**

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Instalasi & Setup](#instalasi--setup)
- [Hak Akses (Role)](#hak-akses-role)
- [Akun Demo](#akun-demo)
- [Credits](#credits)

## Tentang Proyek

**MOTORMAX WMS** adalah solusi all-in-one buat kamu yang:
- Punya ribuan sparepart (oli, ban, kampas rem, velg, shockbreaker, dll)
- Mau stok selalu akurat & anti-selisih
- Butuh sistem approval biar tidak sembarangan keluar-masuk barang
- Ingin bengkel terlihat profesional & kekinian

Sistem ini menerapkan **Multi-Role Access Control** + **Approval Workflow** ketat, sehingga setiap transaksi terkontrol dengan baik.

---

## Fitur Utama

### 1. Multi-Role Access Control

| Role | Email (demo) | Hak Akses Utama |
|------|--------------|-----------------|
| **Admin** | `admin@motormax.com` | Full access: user, kategori, semua data |
| **Manager Bengkel** | `manager@motormax.com` | Approve transaksi, buat PO restock, laporan |
| **Staff / Mekanik** | `staff@motormax.com` | Input transaksi (pending), tambah sparepart |
| **Supplier** | `supplier@motormax.com` | Terima & konfirmasi PO restock |

### 2. Manajemen Stok Bengkel

- Real-time update stok setelah transaksi di-approve
- Low Stock Alert (visual kuning + merah di dashboard)
- Kategori lengkap: Oli, Ban, Rem, Mesin, Aksesoris, dll
- Foto + deskripsi teknis setiap sparepart

### 3. Transaksi Aman & Anti-Selisih

- Staff input → Manager approve → stok berubah
- Bisa input banyak item sekaligus dalam 1 transaksi
- Sistem otomatis blokir jika stok tidak cukup

### 4. Restock / Purchase Order (PO)

**Alur lengkap:**

```
Pending → Confirmed (oleh Supplier) → Shipped → Received (stok otomatis +)
```

Supplier punya portal sendiri untuk konfirmasi/tolak PO.

### 5. Desain Racing Modern

- Tema hitam metalik + merah racing + kuning oli
- Glassmorphism + efek hover agresif
- 100% responsif — bisa dipakai di tablet/PC di bengkel

---

## Teknologi

### Teknologi yang Digunakan

- **Framework:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade + Tailwind CSS (Tema MOTORMAX Racing)
- **Authentication:** Laravel Breeze

---

## Instalasi & Setup

### Cara Instalasi (Lokal)

```bash
# 1. Clone repo
git clone https://github.com/username/motormax-wms.git
cd motormax-wms

# 2. Install dependensi
composer install
npm install

# 3. Setup .env
cp .env.example .env
php artisan key:generate

# 4. Migrasi + Seeder (penting! ada akun default)
php artisan migrate:fresh --seed

# 5. Jalankan
npm run dev
# Terminal baru
php artisan serve
```

**Buka → http://localhost:8000**

---

## Hak Akses (Role)

### Admin
- Full access: user, kategori, semua data

### Manager Bengkel
- Approve transaksi, buat PO restock, laporan

### Staff / Mekanik
- Input transaksi (pending), tambah sparepart

### Supplier
- Terima & konfirmasi PO restock

---

## Akun Demo

### Akun Demo (Default Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@motormax.com | password |
| Manager Bengkel | manager@motormax.com | password |
| Staff / Mekanik | staff@motormax.com | password |
| Supplier | supplier@motormax.com | password |

---

## Aturan Bisnis

### Hapus Sparepart
→ Tidak boleh jika masih ada stok

### Edit Transaksi
→ Hanya yang status *Pending*

### Approval
→ Hanya Manager yang bisa mengubah stok

### Restock
→ Supplier hanya bisa *Confirm / Reject*, tidak bisa edit isi PO

---

## Credits

Dikembangkan untuk **Tugas Final / Proyek Akhir** mata kuliah Pemrograman Web 2025

Tema racing & UI oleh kamu — bengkel jadi kelihatan pro!

---

## MOTORMAX WMS
**Karena bengkel motor keren juga butuh sistem yang keren!**