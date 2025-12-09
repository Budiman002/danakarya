<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register', ['title' => 'Register']);
    }

    // Handle Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:backer,creator'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role' => $validated['role'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to DanaKarya.');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    // Show Profile Page
    public function showProfile()
    {
        return view('auth.profile', [
            'title' => 'Profile',
            'user' => Auth::user()
        ]);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    // Show Settings Page
    public function showSettings()
    {
        return view('auth.settings', [
            'title' => 'Settings',
            'user' => Auth::user()
        ]);
    }

    // Change Password
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    // Show Donation History
    public function donationHistory()
    {
        $donations = Auth::user()
            ->donations()
            ->with('campaign')
            ->latest()
            ->get();

        $stats = [
            'total_donations' => $donations->count(),
            'total_amount' => $donations->where('status', 'confirmed')->sum('amount'),
            'pending_count' => $donations->where('status', 'pending')->count(),
        ];

        return view('profile.donation-history', [
            'title' => 'Donation History',
            'donations' => $donations,
            'stats' => $stats,
        ]);
    }
}