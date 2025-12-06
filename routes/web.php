<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CampaignController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{slug}', [CampaignController::class, 'show'])->name('campaigns.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password', ['title' => 'Forgot Password']);
    })->name('password.request');
    
    Route::post('/forgot-password', function () {
        return back()->with('status', 'Password reset link sent! (Placeholder - email not actually sent)');
    })->name('password.email');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [AuthController::class, 'showSettings'])->name('settings');
    Route::put('/settings/password', [AuthController::class, 'changePassword'])->name('password.change');
    
    Route::get('/notifications', function () {
        return view('profile.notifications', ['title' => 'Notifications']);
    })->name('notifications');
    
    Route::get('/donation-history', function () {
        return view('profile.donation-history', ['title' => 'Donation History']);
    })->name('donation.history');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $totalCampaigns = \App\Models\Campaign::count();
        $pendingCampaigns = \App\Models\Campaign::where('status', 'pending')->count();
        $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
        $totalUsers = \App\Models\User::count();
        
        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'subtitle' => 'Platform overview',
            'totalCampaigns' => $totalCampaigns,
            'pendingCampaigns' => $pendingCampaigns,
            'activeCampaigns' => $activeCampaigns,
            'totalUsers' => $totalUsers,
        ]);
    })->name('dashboard');
    
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class)->except(['create', 'store']);
    Route::post('campaigns/{id}/approve', [\App\Http\Controllers\Admin\CampaignController::class, 'approve'])->name('campaigns.approve');
    Route::post('campaigns/{id}/reject', [\App\Http\Controllers\Admin\CampaignController::class, 'reject'])->name('campaigns.reject');
});

// Creator Routes
Route::middleware(['auth', 'creator'])->prefix('creator')->name('creator.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Creator\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/campaigns', [\App\Http\Controllers\Creator\CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/create', [\App\Http\Controllers\Creator\CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [\App\Http\Controllers\Creator\CampaignController::class, 'store'])->name('campaigns.store');
});

// Backer Routes
Route::middleware(['auth', 'backer'])->prefix('backer')->name('backer.')->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome', ['title' => 'Backer Dashboard']);
    })->name('dashboard');
});