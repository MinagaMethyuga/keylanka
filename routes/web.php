<?php

use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FlipKeys;
use App\Http\Controllers\KeyCovers;
use App\Http\Controllers\KeyShells;
use App\Http\Controllers\LocksmithTools;
use App\Http\Controllers\Other;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemoteKeys;
use App\Http\Controllers\SmartKey;
use App\Http\Controllers\TwoFactorAuthenticationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home & About
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/AboutUs', function () {
    return view('AboutUs');
})->name('AboutUs');

// Product Catalog Routes
Route::prefix('LocksmithTools')->name('products.')->group(function () {
    Route::get('/', [LocksmithTools::class, 'index'])->name('index');
    Route::get('/KeyDiy', [LocksmithTools::class, 'KeyDIYIndex'])->name('KeyDiy');
    Route::get('/xHorse', [LocksmithTools::class, 'xHorseIndex'])->name('xHorse');
    Route::get('/Other', [LocksmithTools::class, 'OtherIndex'])->name('Other');
});

Route::get('/FlipKeys', [FlipKeys::class, 'index'])->name('FlipKey.index');
Route::get('/KeyShells', [KeyShells::class, 'index'])->name('KeyShells.index');
Route::get('/KeyCovers', [KeyCovers::class, 'index'])->name('KeyCover.index');
Route::get('/Other', [Other::class, 'index'])->name('Other.index');

Route::prefix('RemoteKeys')->name('Remote.')->group(function () {
    Route::get('/', [RemoteKeys::class, 'index'])->name('index');
    Route::get('/{brand}', [RemoteKeys::class, 'showByBrand'])->name('brand');
});

Route::prefix('SmartKeys')->name('Smart.')->group(function () {
    Route::get('/', [SmartKey::class, 'index'])->name('index');
    Route::get('/{brand}', [SmartKey::class, 'showByBrand'])->name('brand');
});

// Checkout & Payment Routes
Route::get('/checkout', function () {
    return view('CheckoutPage');
})->name('checkout');

Route::post('/checkoutpay', [PaymentController::class, 'preparePayment']);
Route::get('/payment/return', [PaymentController::class, 'paymentReturn'])->name('payment.return');
Route::get('/Confirmation', function () {
    return view('ConfirmationPage');
})->name('payment.Confirmation');

Route::post('/payhere-notify', [PaymentController::class, 'PaymentNotify'])
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// Order Tracking
Route::get('/track-order', [PaymentController::class, 'trackOrder'])->name('order.track');

// Email Verification
Route::post('/verify-code', [EmailController::class, 'verifyCode'])->name('verify.code');
Route::post('/verify-email', [EmailController::class, 'verifyEmail'])->name('verify.email');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| Laravel Fortify handles most auth routes automatically.
| These are custom views/overrides.
*/

Route::get('/register', function () {
    return view('livewire.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('livewire.auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // User Profile & Settings
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Password Management
    Route::prefix('user')->group(function () {
        Route::get('/password', [PasswordController::class, 'edit'])->name('user-password.edit');
        Route::put('/password', [PasswordController::class, 'update'])->name('user-password.update');

        // Two-Factor Authentication
        Route::get('/two-factor-authentication', [TwoFactorAuthenticationController::class, 'show'])
            ->middleware(['password.confirm'])
            ->name('two-factor.show');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Product Management
    Route::get('/ManageProducts', [AdminDashboard::class, 'ManageKeyIndex'])->name('Manage.Products.index');
    Route::get('/add-key', function () {
        return view('AddKeyAdmin');
    })->name('add-key');

    // Product API Routes
    Route::prefix('products')->name('admin.products.')->group(function () {
        Route::get('/{id}', [ProductsController::class, 'getProduct'])->name('get');
        Route::post('/', [ProductsController::class, 'store'])->name('store');
        Route::put('/{id}', [ProductsController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('destroy');
    });

    // Order Management
    Route::prefix('orders')->name('admin.orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('manage');
        Route::get('/{orderId}', [OrderController::class, 'show'])->name('show');
        Route::post('/{orderId}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');
    });

    // Legacy route alias for order management
    Route::get('/ManageOrders', [OrderController::class, 'index'])->name('admin.order.manage');
});

// Legacy route for adding products (backward compatibility)
Route::post('/addProducts', [ProductsController::class, 'store'])->name('addProducts.store');

Route::get('/settings/appearance', function () {
    return view('settings.appearance');
})->name('appearance.edit');

