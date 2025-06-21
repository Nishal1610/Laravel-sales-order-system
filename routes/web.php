<?php

use App\Http\Controllers\{SalesOrderController, ProductController, ProfileController, DashboardController};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

   Route::get('/', function () {
        return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
    });

  Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes (only for users with role: admin)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    // Salesperson routes (only for users with role: sales)
    //  Route::middleware(['auth', 'role:sales|admin'])->group(function () {
     Route::middleware(['auth', 'role:sales'])->group(function () {
        Route::get('/sales/orders', [SalesOrderController::class, 'index'])->name('sales.orders');
        Route::get('/sales/orders/create', [SalesOrderController::class, 'create'])->name('sales.orders.create');
        Route::post('/sales/orders', [SalesOrderController::class, 'store'])->name('sales.orders.store');
        // Route::get('/sales/orders/{order}', [SalesOrderController::class, 'show'])->name('sales.orders.show');
        Route::get('/sales/orders/{order}/pdf', [SalesOrderController::class, 'exportPdf'])->name('sales.orders.pdf');
    });



});

require __DIR__.'/auth.php';

