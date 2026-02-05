<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['user', 'developer', 'projectType'])
            ->latest()
            ->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['user', 'developer', 'projectType', 'tasks', 'platforms', 'features']);
        $developers = User::role('developer')->get();

        return view('admin.projects.show', compact('project', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'developer_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
        ]);

        $project->update([
            'developer_id' => $request->developer_id,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Projet mis à jour avec succès.');
    }
}