<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $developers = User::role('developer')->with('projects')->get();
        $projectManagers = User::role('project_manager')->with('managedProjects')->get();
        $communityManagers = User::role('community_manager')->with('communityProjects')->get();

        return view('admin.team.index', compact('developers', 'projectManagers', 'communityManagers'));
    }

    public function show(User $user)
    {
        $user->load(['projects.projectType', 'managedProjects.projectType', 'communityProjects.projectType', 'assignedTasks.project']);
        return view('admin.team.show', compact('user'));
    }
}
