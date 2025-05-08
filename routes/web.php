<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', fn() => view('index'));
Route::get('/kasir', fn() => view('pages.kasir'));
Route::get('/member', fn() => view('pages.member'));
Route::get('/riwayat', fn() => view('pages.riwayat'));
Route::get('/login', fn() => view('login'));

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::post('/produk', [ProductController::class, 'store'])->name('products.store');
Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
Route::get('/produk/{product}', [ProductController::class, 'show'])->name('produk.show');
Route::put('/produk/{product}', [ProductController::class, 'update'])->name('produk.update');
Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
