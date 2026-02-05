<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('developer')) {
            $projects = Project::with(['user', 'projectType.category'])->latest()->paginate(10);
            $stats = [
                'total_projects' => Project::count(),
                'total_value' => Project::sum('total_price'),
                'active_clients' => Project::distinct('user_id')->count(),
            ];
        } else {
            $projects = Project::where('user_id', $user->id)
                ->with(['projectType.category'])
                ->latest()
                ->paginate(10);
            $stats = [
                'total_projects' => $projects->total(),
                'total_value' => Project::where('user_id', $user->id)->sum('total_price'),
                'pending_quotes' => Project::where('user_id', $user->id)->where('status', 'pending')->count(),
            ];
        }

        return view('dashboard', compact('projects', 'stats'));
    }
}
