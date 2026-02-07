<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Show templates for a project filtered by project type
     */
    public function index(Project $project)
    {
        // Ensure user owns this project
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        // Get templates for this project type
        $templates = Template::where('project_type_id', $project->project_type_id)
            ->active()
            ->with('components')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get unique categories for filtering
        $categories = Template::where('project_type_id', $project->project_type_id)
            ->distinct()
            ->pluck('category');

        return view('client.templates.index', compact('project', 'templates', 'categories'));
    }

    /**
     * Preview a template with all its details
     */
    public function preview(Project $project, Template $template)
    {
        // Ensure user owns this project
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        // Ensure template matches project type
        if ($template->project_type_id !== $project->project_type_id) {
            abort(403, 'Ce template n\'est pas compatible avec votre type de projet.');
        }

        $template->load([
            'components' => function ($query) {
                $query->orderBy('template_components.sort_order');
            }
        ]);

        return view('client.templates.preview', compact('project', 'template'));
    }

    /**
     * Select a template for the project
     */
    public function select(Request $request, Project $project)
    {
        // Ensure user owns this project
        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id'
        ]);

        $template = Template::findOrFail($validated['template_id']);

        // Ensure template matches project type
        if ($template->project_type_id !== $project->project_type_id) {
            return back()->with('error', 'Ce template n\'est pas compatible avec votre type de projet.');
        }

        // Assign template to project
        $project->update(['template_id' => $template->id]);

        return redirect()
            ->route('client.projects.show', $project)
            ->with('success', 'Template sélectionné avec succès !');
    }

    /**
     * Show live preview of template (public, no auth required)
     */
    public function livePreview(Template $template)
    {
        $template->load([
            'components' => function ($query) {
                $query->orderBy('template_components.sort_order');
            }
        ]);

        return view('templates.live-preview', compact('template'));
    }
}
