<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'total_value' => Project::sum('total_price'),
            'total_users' => User::count(),
            'pending_projects' => Project::where('status', 'pending')->count(),
        ];

        $recentProjects = Project::with(['user', 'developer', 'projectType'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }
}