<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DapurOrderController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DapurController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/harga', function () {
    return view('harga');
})->name('harga');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->hasRole('dapur')) {
            return redirect()->route('dapur.dashboard');
        } elseif (auth()->user()->hasRole('supplier')) {
            return redirect()->route('supplier.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');



    //ADMIN
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.dashboard');
        })->name('admin.dashboard');

        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');

        Route::get('/orders', [OrderController::class, 'index'])->name('admin.order.index');

        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.order.show');

        Route::get('/dapur', [DapurController::class, 'index'])->name('admin.dapur.index');
        Route::get('/dapur/create', function () {
            return view('admin.dapur.create');
        })->name('admin.dapur.create');
        Route::post('/dapur/store', [DapurController::class, 'store'])->name('admin.dapur.store');
        Route::get('/dapur/{user}', [DapurController::class, 'show'])->name('admin.dapur.show');
        Route::get('/dapur/{user}/edit', [DapurController::class, 'edit'])->name('admin.dapur.edit');
        Route::patch('/dapur/{user}', [DapurController::class, 'update'])->name('admin.dapur.update');
        Route::delete('/dapur/{user}', [DapurController::class, 'destroy'])->name('admin.dapur.destroy');

        Route::get('/supplier', [SupplierController::class, 'index'])->name('admin.supplier.index');
        Route::get('/supplier/create', function () {
            return view('admin.supplier.create');
        })->name('admin.supplier.create');
        Route::post('/supplier/store', [SupplierController::class, 'store'])->name('admin.supplier.store');
        Route::get('/supplier/{user}', [SupplierController::class, 'show'])->name('admin.supplier.show');
        Route::get('/supplier/{user}/edit', [SupplierController::class, 'edit'])->name('admin.supplier.edit');
        Route::patch('/supplier/{user}', [SupplierController::class, 'update'])->name('admin.supplier.update');
        Route::delete('/supplier/{user}', [SupplierController::class, 'destroy'])->name('admin.supplier.destroy');


        Route::post('/admin/orders/{order}/send', [OrderController::class, 'sendToDapurSupplier'])->name('admin.order.send');
    });



    //DAPUR
    Route::middleware(['role:dapur'])->prefix('dapur')->group(function () {
        Route::get('/dashboard', function () {
            return view('dapur.dashboard.dashboard');
        })->name('dapur.dashboard');

        Route::get('/inventory', function () {
            return view('dapur.inventory');
        })->name('dapur.inventory');

        Route::get('/orders', [DapurOrderController::class, 'index'])->name('dapur.orders');

        Route::get('/orders/{order}', [DapurOrderController::class, 'show'])->name('dapur.order.show');

        Route::post('/orders/{order}/update-status', [DapurOrderController::class, 'updateStatus'])
            ->name('dapur.order.updateStatus');

        Route::get('/stok', function () {
            return view('dapur.stok.index');
        })->name('dapur.stok');
    });



    //SUPPLIER
    Route::middleware(['role:supplier'])->prefix('supplier')->group(function () {
        Route::get('/dashboard', function () {
            return view('supplier.dashboard.dashboard');
        })->name('supplier.dashboard');

        Route::get('/products', function () {
            return view('supplier.products');
        })->name('supplier.products');

        Route::get('/deliveries', function () {
            return view('supplier.deliveries');
        })->name('supplier.deliveries');

        Route::get('/orders', [SupplierOrderController::class, 'index'])->name('supplier.orders');
        Route::get('/orders/{order}', [SupplierOrderController::class, 'show'])->name('supplier.order.show');

        Route::get('/stok', function () {
            return view('supplier.stok.index');
        })->name('supplier.stok');

        Route::post('/orders/{order}/update-status', [SupplierOrderController::class, 'updateStatus'])
            ->name('supplier.order.updateStatus');
    });



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::post('/midtrans/token', [OrderController::class, 'midtransToken']);
Route::post('/midtrans/notification', [OrderController::class, 'midtransNotification']);
Route::post('/order/update-status', [OrderController::class, 'updateStatus']);
Route::get('/order/success', [OrderController::class, 'orderSuccess']);

require __DIR__ . '/auth.php';
