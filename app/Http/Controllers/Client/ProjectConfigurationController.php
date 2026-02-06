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
            // New fields
            'specifications_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'specifications_content' => 'nullable|string',
            'reference_sites' => 'nullable|array',
            'reference_sites.*.url' => 'required_with:reference_sites|url',
            'reference_sites.*.description' => 'nullable|string|max:500',
            'resources' => 'nullable|array',
            'resources.*' => 'file|max:5120',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('projects/logos', 'public');
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $validated['banner_path'] = $request->file('banner')->store('projects/banners', 'public');
        }

        // Handle specifications file upload
        if ($request->hasFile('specifications_file')) {
            $validated['specifications_file_path'] = $request->file('specifications_file')->store('projects/specifications', 'public');
        }

        // Filter out empty reference sites (sites with no URL)
        if (isset($validated['reference_sites']) && is_array($validated['reference_sites'])) {
            $validated['reference_sites'] = array_values(array_filter($validated['reference_sites'], function ($site) {
                return !empty($site['url']);
            }));

            // If no valid sites, set to null instead of empty array
            if (empty($validated['reference_sites'])) {
                $validated['reference_sites'] = null;
            }
        }

        // Handle multiple resource files upload
        if ($request->hasFile('resources')) {
            $resourcePaths = [];
            foreach ($request->file('resources') as $file) {
                $path = $file->store('projects/resources', 'public');
                $resourcePaths[] = [
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'uploaded_at' => now()->toDateTimeString(),
                ];
            }

            // Merge with existing resources if any
            $existingResources = $project->configuration?->resource_files ?? [];
            $validated['resource_files'] = array_merge($existingResources, $resourcePaths);
        }

        $project->configuration()->updateOrCreate(
            ['project_id' => $project->id],
            $validated
        );

        return redirect()->back()->with('success', 'Configuration mise à jour avec succès !');
    }
}
