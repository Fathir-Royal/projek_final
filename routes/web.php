<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function(){ return redirect('/dashboard'); });

Route::middleware(['auth'])->group(function(){

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Admin-only
    Route::middleware('role:admin')->group(function(){
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);

        Route::get('suppliers/pending', [AdminController::class,'pendingSuppliers'])->name('admin.suppliers.pending');
        Route::post('suppliers/{id}/approve', [AdminController::class,'approveSupplier'])->name('admin.suppliers.approve');
    });

    // Manager
    Route::middleware('role:manager')->group(function(){
        Route::get('transactions/{type}', [TransactionController::class,'index'])->name('transactions.index');
        Route::post('transactions/{type}', [TransactionController::class,'store'])->name('transactions.store');
        Route::post('transactions/{id}/approve', [TransactionController::class,'approve'])->name('transactions.approve');

        Route::get('restocks', [RestockController::class,'index'])->name('restocks.index');
        Route::get('restocks/create', [RestockController::class,'create'])->name('restocks.create');
        Route::post('restocks', [RestockController::class,'store'])->name('restocks.store');
        Route::post('restocks/{id}/ship', [RestockController::class,'ship'])->name('restocks.ship');
    });

    // Staff
    Route::middleware('role:staff')->group(function(){
        Route::get('transactions/{type}', [TransactionController::class,'index'])->name('transactions.index');
        Route::post('transactions/{type}', [TransactionController::class,'store'])->name('transactions.store');
        Route::post('restocks/{id}/receive', [RestockController::class,'receive'])->name('restocks.receive');
    });

    // Supplier
    Route::middleware('role:supplier')->group(function(){
        Route::get('supplier/restocks', [RestockController::class,'indexForSupplier'])->name('supplier.restocks');
        Route::post('supplier/restocks/{id}/confirm', [RestockController::class,'confirm'])->name('supplier.restocks.confirm');
    });
});

require __DIR__.'/auth.php';
