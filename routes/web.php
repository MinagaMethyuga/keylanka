<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;


//public Views
Route::get('/', function () {
    return view('Maintainance');
})->name('home');

Route::get('/Confirmation', function () {
    return view('ConfirmationPage');
})->name('Confrimation');

Route::get('/LocksmithTools', [App\Http\Controllers\LocksmithTools::class, 'index'])->name('products.index');
Route::get('/LocksmithTools/KeyDiy', [App\Http\Controllers\LocksmithTools::class, 'KeyDIYIndex'])->name('products.KeyDiy');
Route::get('/LocksmithTools/xHorse', [App\Http\Controllers\LocksmithTools::class, 'xHorseIndex'])->name('products.xHorse');
Route::get('/LocksmithTools/Other', [App\Http\Controllers\LocksmithTools::class, 'OtherIndex'])->name('products.Other');
Route::get('/FlipKeys', [App\Http\Controllers\FlipKeys::class, 'index'])->name('FlipKey.index');
Route::get('/KeyShells', [App\Http\Controllers\KeyShells::class, 'index'])->name('KeyShells.index');
Route::get('/RemoteKeys', [App\Http\Controllers\RemoteKeys::class, 'index'])->name('Remote.index');
Route::get('/RemoteKeys/{brand}', [App\Http\Controllers\RemoteKeys::class, 'showByBrand'])->name('Remote.brand');
Route::get('/SmartKeys', [App\Http\Controllers\SmartKey::class, 'index'])->name('Smart.index');
Route::get('/SmartKeys/{brand}', [App\Http\Controllers\SmartKey::class, 'showByBrand'])->name('Smart.brand');
Route::get('/KeyCovers', [App\Http\Controllers\KeyCovers::class, 'index'])->name('KeyCover.index');
Route::get('/Other', [App\Http\Controllers\Other::class, 'index'])->name('Other.index');

Route::post('/verify-code', [\App\Http\Controllers\EmailController::class, 'verifyCode'])->name('verify.code');
Route::post('/verify-email', [\App\Http\Controllers\EmailController::class, 'verifyEmail'])->name('verify.email');
Route::get('/payment/return', [\App\Http\Controllers\PaymentController::class, 'paymentReturn'])->name('payment.return');

Route::post('/checkoutpay', [\App\Http\Controllers\PaymentController::class, 'preparePayment']);
Route::post('/payhere-notify', [\App\Http\Controllers\PaymentController::class, 'PaymentNotify'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/Confirmation', function () {
    return view('ConfirmationPage');
})->name('payment.Confirmation');

Route::get('/track-order', [\App\Http\Controllers\PaymentController::class, 'trackOrder'])->name('order.track');

Route::get('/AboutUs', function () {
    return view('AboutUs');
})->name('AboutUs');

Route::get('/registryofdoom', function () {
    return view('livewire.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('livewire.auth.login');
})->name('login');

Route::get('/checkout', function () {
    return view('CheckoutPage');
})->name('checkout');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');


//Private views
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboard::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/ManageProducts', [\App\Http\Controllers\Admin\AdminDashboard::class, 'ManageKeyIndex'])->name('Manage.Products.index');

    Route::get('/add-key', function () {
        return view('AddKeyAdmin');
    })->name('add-key');

    // Order Management Routes
    Route::get('/ManageOrders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order.manage');
    Route::get('/orders/{orderId}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{orderId}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Product Management Routes
    Route::prefix('admin')->group(function () {
        // Get single product (for edit modal)
        Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'getProduct'])->name('admin.products.get');

        // Create product
        Route::post('/products', [App\Http\Controllers\ProductsController::class, 'store'])->name('admin.products.store');

        // Update product
        Route::put('/products/{id}', [App\Http\Controllers\ProductsController::class, 'update'])->name('admin.products.update');

        // Delete product
        Route::delete('/products/{id}', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('admin.products.destroy');
    });
});

// Legacy route for adding products (keeping for backward compatibility if needed)
Route::post('/addProducts', [App\Http\Controllers\ProductsController::class, 'store'])->name('addProducts.store');
