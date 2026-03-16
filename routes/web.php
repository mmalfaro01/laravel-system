<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\StoreProductController;

// Public Home
Route::get('/', function () {
    $burgersCategory = Category::where('slug', 'burgers')->first();
    $snacksCategory  = Category::where('slug', 'snacks')->first();
    $drinksCategory  = Category::where('slug', 'drinks')->first();

    $burgers = $burgersCategory
        ? $burgersCategory->products()->latest()->take(8)->get()
        : collect();

    $snacks = $snacksCategory
        ? $snacksCategory->products()->latest()->take(8)->get()
        : collect();

    $drinks = $drinksCategory
        ? $drinksCategory->products()->latest()->take(8)->get()
        : collect();

    // Featured product for hero (first burger, or any product)
    $featured = $burgers->first() ?: Product::latest()->first();

    return view('welcome', compact('burgers', 'snacks', 'drinks', 'featured'));
})->name('home');

// Auth routes for users
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product routes
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout
Route::prefix('checkout')->middleware('auth')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Orders
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Auth
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Admin Protected Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('categories', [AdminController::class, 'categories'])->name('categories');
        Route::get('attributes', [AdminController::class, 'attributes'])->name('attributes');
        Route::get('reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::get('notifications', [AdminController::class, 'notifications'])->name('notifications');
        Route::get('logs', [AdminController::class, 'logs'])->name('logs');
        Route::get('profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('support', [AdminController::class, 'support'])->name('support');
        Route::get('help', [AdminController::class, 'help'])->name('help');
        Route::get('faq', [AdminController::class, 'faq'])->name('faq');
        Route::get('terms', [AdminController::class, 'terms'])->name('terms');
        Route::get('privacy', [AdminController::class, 'privacy'])->name('privacy');
        Route::get('about', [AdminController::class, 'about'])->name('about');
        Route::get('contact', [AdminController::class, 'contact'])->name('contact');
        Route::get('feedback', [AdminController::class, 'feedback'])->name('feedback');
        Route::get('updates', [AdminController::class, 'updates'])->name('updates');

        // Admin Products
        Route::resource('products', AdminProductController::class)->except(['show']);

        // User Management (Users tab)
        Route::get('users', [AdminController::class, 'users'])->name('users');
        Route::delete('users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // Admin Management (Admins tab)
        Route::get('admins/create', [AdminController::class, 'createAdmin'])->name('admins.create');
        Route::post('admins', [AdminController::class, 'storeAdmin'])->name('admins.store');

        // Reseller Store Management
        Route::resource('stores', StoreController::class);
        Route::get('store/{store}/products', [StoreProductController::class, 'index'])->name('store.products');
   
Route::get('orders', [AdminController::class, 'manageOrders'])->name('orders');
Route::get('orders/{order}/edit', [AdminController::class, 'editOrder'])->name('orders.edit');
Route::put('orders/{order}', [AdminController::class, 'updateOrder'])->name('orders.update');

    });
});

// Logout for normal users
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Social Login
Route::get('/login/google', [SocialLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
Route::get('/login/facebook', [SocialLoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);

// Static Pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/facebook-data-deletion', 'pages.data_deletion')->name('facebook.data.deletion');

// Public FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// Notifications
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');
});

// Contact Form
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

use App\Http\Controllers\ReportController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('sales-report', [ReportController::class, 'sales'])->name('sales.report');
    // ... other routes
});

