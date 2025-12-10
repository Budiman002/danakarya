<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->role && in_array($request->role, ['admin', 'creator', 'backer'])) {
            $query->where('role', $request->role);
        }

        // Search by name or email
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'newest');
        if ($sortBy === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // Load relationships and counts
        $users = $query->withCount([
            'campaigns',
            'donations' => function($q) {
                $q->where('status', 'confirmed');
            }
        ])->paginate(15);

        // Statistics
        $totalUsers = User::count();
        $totalCreators = User::where('role', 'creator')->count();
        $totalBackers = User::where('role', 'backer')->count();
        $newUsersLast7Days = User::where('created_at', '>=', now()->subDays(7))->count();

        return view('admin.users.index', [
            'title' => 'User Management',
            'subtitle' => 'Manage all users',
            'users' => $users,
            'totalUsers' => $totalUsers,
            'totalCreators' => $totalCreators,
            'totalBackers' => $totalBackers,
            'newUsersLast7Days' => $newUsersLast7Days,
        ]);
    }

    public function show($id)
    {
        $user = User::withCount([
            'campaigns',
            'donations' => function($q) {
                $q->where('status', 'confirmed');
            }
        ])->findOrFail($id);

        // Get user's campaigns if creator
        $campaigns = [];
        if ($user->isCreator()) {
            $campaigns = $user->campaigns()->withCount('donations')->latest()->get();
        }

        // Get user's donations if backer
        $donations = [];
        $totalDonated = 0;
        if ($user->role === 'backer' || $user->donations_count > 0) {
            $donations = $user->donations()
                ->with('campaign')
                ->where('status', 'confirmed')
                ->latest()
                ->get();
            $totalDonated = $donations->sum('amount');
        }

        // User statistics
        $stats = [
            'total_campaigns' => $user->campaigns_count ?? 0,
            'total_donations_made' => $user->donations_count ?? 0,
            'total_donated' => $totalDonated,
            'total_raised' => $user->isCreator() ? $user->campaigns->sum('current_amount') : 0,
        ];

        return view('admin.users.show', [
            'title' => 'User Detail',
            'subtitle' => $user->name,
            'user' => $user,
            'campaigns' => $campaigns,
            'donations' => $donations,
            'stats' => $stats,
        ]);
    }
}
