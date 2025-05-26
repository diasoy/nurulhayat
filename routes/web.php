<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.dashboard');
        })->name('admin.dashboard');

        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');

        Route::get('/reports', function () {
            return view('admin.reports');
        })->name('admin.reports');
    });

    Route::middleware(['role:dapur'])->prefix('dapur')->group(function () {
        Route::get('/dashboard', function () {
            return view('dapur.dashboard.dashboard');
        })->name('dapur.dashboard');

        Route::get('/inventory', function () {
            return view('dapur.inventory');
        })->name('dapur.inventory');

        Route::get('/orders', function () {
            return view('dapur.orders');
        })->name('dapur.orders');
    });

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
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/midtrans/token', [OrderController::class, 'midtransToken']);
    Route::post('/midtrans/notification', [OrderController::class, 'midtransNotification']);
    Route::post('/order/update-status', [OrderController::class, 'updateStatus']);
    Route::get('/order/success', function () {
        return view('order-success');
    });
});

require __DIR__ . '/auth.php';
