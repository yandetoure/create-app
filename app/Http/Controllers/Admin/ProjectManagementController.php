<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use App\Models\Deliverable;
use App\Models\Task;
#[\Illuminate\Routing\Controllers\Middleware('auth')]
class ProjectManagementController extends Controller
{
    public function manage(Project $project)
    {
        $project->load(['user', 'developer', 'projectManager', 'communityManager', 'tasks.assignedUser', 'deliverables']);

        $developers = User::role('developer')->get();
        $projectManagers = User::role('project_manager')->get();
        $communityManagers = User::role('community_manager')->get();

        return view('admin.projects.manage', compact('project', 'developers', 'projectManagers', 'communityManagers'));
    }

    public function assign(\Illuminate\Http\Request $request, Project $project)
    {
        $validated = $request->validate([
            'developer_id' => 'nullable|exists:users,id',
            'project_manager_id' => 'nullable|exists:users,id',
            'community_manager_id' => 'nullable|exists:users,id',
        ]);

        $project->update($validated);

        return redirect()->back()->with('success', 'Équipe mise à jour pour ce projet.');
    }

    public function storeDeliverable(\Illuminate\Http\Request $request, Project $project)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'label' => 'required|string|max:255',
            'url' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $project->deliverables()->create($validated);

        return redirect()->back()->with('success', 'Livrable ajouté.');
    }

    public function storeTask(\Illuminate\Http\Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $project->tasks()->create($validated);

        return redirect()->back()->with('success', 'Tâche créée et assignée.');
    }

    public function updateTaskStatus(\Illuminate\Http\Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($validated);

        return redirect()->back()->with('success', 'Statut de la tâche mis à jour.');
    }
}
