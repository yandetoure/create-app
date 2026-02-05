<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function show($slug)
    {
        $project = Project::where('preview_slug', $slug)
            ->with(['projectType.category', 'features'])
            ->firstOrFail();

        $components = $project->features
            ->whereNotNull('component_name')
            ->pluck('component_name')
            ->unique()
            ->toArray();

        // Always include hero and contact
        array_unshift($components, 'hero');
        $components[] = 'contact';

        return view('preview.show', [
            'project' => $project,
            'components' => $components,
            'isMobile' => $project->projectType->category->slug === 'app-mobile'
        ]);
    }
}
