<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'managed_projects' => Project::count(),
            'urgent_tasks' => \App\Models\Task::where('status', 'pending')->count(),
        ];

        $projects = Project::with(['user', 'developer', 'projectType'])->latest()->paginate(10);

        return view('lead.dashboard', compact('stats', 'projects'));
    }
}