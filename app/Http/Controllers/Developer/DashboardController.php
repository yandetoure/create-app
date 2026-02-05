<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $assignedProjects = Project::where('developer_id', $user->id)
            ->with(['user', 'projectType', 'tasks'])
            ->latest()
            ->paginate(10);

        $stats = [
            'my_projects' => $assignedProjects->total(),
            'pending_tasks' => \App\Models\Task::whereIn('project_id', $assignedProjects->pluck('id'))
                ->where('status', '!=', 'completed')
                ->count(),
            'completed_projects' => Project::where('developer_id', $user->id)
                ->where('status', 'completed')
                ->count(),
        ];

        return view('developer.dashboard', compact('assignedProjects', 'stats'));
    }
}