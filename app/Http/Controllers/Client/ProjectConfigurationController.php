<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectConfiguration;
use Illuminate\Http\Request;

class ProjectConfigurationController extends Controller
{
    public function edit(Project $project)
    {
        // Ensure user owns the project
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $configuration = $project->configuration ?? new ProjectConfiguration();

        return view('client.projects.configure', compact('project', 'configuration'));
    }

    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'accent_color' => 'nullable|string|max:7',
            'domain_name' => 'nullable|string|max:255',
            'design_style' => 'nullable|string|max:255',
            'copywriting_brief' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string',
            'opening_hours' => 'nullable|string',
            'form_types' => 'nullable|array',
            'logo' => 'nullable|image|max:2048',
            'banner' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('projects/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            $validated['banner_path'] = $request->file('banner')->store('projects/banners', 'public');
        }

        $project->configuration()->updateOrCreate(
            ['project_id' => $project->id],
            $validated
        );

        return redirect()->back()->with('success', 'Configuration mise à jour avec succès !');
    }
}
