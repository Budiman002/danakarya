<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CampaignController;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');
// Campaign Routes (public)
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{slug}', [CampaignController::class, 'show'])->name('campaigns.show');

// Guest Routes (Not logged in)
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Forgot Password
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password', ['title' => 'Forgot Password']);
    })->name('password.request');
    
    Route::post('/forgot-password', function () {
        return back()->with('status', 'Password reset link sent! (Placeholder - email not actually sent)');
    })->name('password.email');
});

// Authenticated Routes (Logged in)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (redirect based on role)
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isCreator()) {
        return redirect()->route('creator.dashboard');
    } else {
        return redirect()->route('backer.dashboard');
    }
    })->name('dashboard');

    // Profile
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Settings
    Route::get('/settings', [AuthController::class, 'showSettings'])->name('settings');
    Route::put('/settings/password', [AuthController::class, 'changePassword'])->name('password.change');

    // Notifications (placeholder)
    Route::get('/notifications', function () {
        return view('profile.notifications', ['title' => 'Notifications']);
    })->name('notifications');

    // Donation History (placeholder)
    Route::get('/donation-history', function () {
        return view('profile.donation-history', ['title' => 'Donation History']);
    })->name('donation.history');
});

// Role-based Routes (Protected by middleware)

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome', ['title' => 'Admin Dashboard']);
    })->name('dashboard');
    
    // Category Management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});

// Creator Routes
Route::middleware(['auth', 'creator'])->prefix('creator')->name('creator.')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome', ['title' => 'Creator Dashboard']);
    })->name('dashboard');
});

// Backer Routes
Route::middleware(['auth', 'backer'])->prefix('backer')->name('backer.')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome', ['title' => 'Backer Dashboard']);
    })->name('dashboard');
});