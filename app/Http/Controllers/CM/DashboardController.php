<?php

namespace App\Http\Controllers\CM;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'new_projects' => Project::where('status', 'new')->count(),
            'ongoing_projects' => Project::where('status', 'in_progress')->count(),
        ];

        $projects = Project::with(['user', 'projectType'])->latest()->paginate(10);

        return view('cm.dashboard', compact('stats', 'projects'));
    }
}