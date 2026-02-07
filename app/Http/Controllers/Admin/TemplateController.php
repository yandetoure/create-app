<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\ProjectType;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = Template::with('projectType');

        // Filter by project type
        if ($request->filled('project_type_id')) {
            $query->where('project_type_id', $request->project_type_id);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $templates = $query->orderBy('sort_order')->orderBy('name')->paginate(20);
        $projectTypes = ProjectType::all();

        return view('admin.templates.index', compact('templates', 'projectTypes'));
    }

    public function create()
    {
        $projectTypes = ProjectType::all();
        $categories = $this->getCategories();

        return view('admin.templates.create', compact('projectTypes', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_type_id' => 'required|exists:project_types,id',
            'category' => 'required|string',
            'preview_image' => 'nullable|image|max:5120',
            'thumbnail_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image uploads
        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('templates/previews', 'public');
        }

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('templates/thumbnails', 'public');
        }

        Template::create($validated);

        return redirect()->route('admin.templates.index')->with('success', 'Template créé avec succès !');
    }

    public function show(Template $template)
    {
        $template->load(['projectType', 'components']);
        $availableComponents = Component::active()->get()->groupBy('type');

        return view('admin.templates.show', compact('template', 'availableComponents'));
    }

    public function edit(Template $template)
    {
        $projectTypes = ProjectType::all();
        $categories = $this->getCategories();

        return view('admin.templates.edit', compact('template', 'projectTypes', 'categories'));
    }

    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_type_id' => 'required|exists:project_types,id',
            'category' => 'required|string',
            'preview_image' => 'nullable|image|max:5120',
            'thumbnail_image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image uploads
        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('templates/previews', 'public');
        }

        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('templates/thumbnails', 'public');
        }

        $template->update($validated);

        return redirect()->route('admin.templates.show', $template)->with('success', 'Template mis à jour !');
    }

    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('admin.templates.index')->with('success', 'Template supprimé !');
    }

    public function toggleActive(Template $template)
    {
        $template->update(['is_active' => !$template->is_active]);
        return back()->with('success', 'Statut mis à jour !');
    }

    public function assignComponent(Request $request, Template $template)
    {
        $validated = $request->validate([
            'component_id' => 'required|exists:components,id',
            'section_name' => 'required|string',
            'sort_order' => 'nullable|integer',
            'default_settings' => 'nullable|array',
        ]);

        $template->components()->attach($validated['component_id'], [
            'section_name' => $validated['section_name'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'default_settings' => $validated['default_settings'] ?? null,
        ]);

        return back()->with('success', 'Composant ajouté au template !');
    }

    public function removeComponent(Template $template, Component $component)
    {
        $template->components()->detach($component->id);
        return back()->with('success', 'Composant retiré du template !');
    }

    private function getCategories()
    {
        return [
            'e-commerce' => 'E-commerce',
            'hotel' => 'Hôtellerie',
            'recipe' => 'Recettes',
            'vitrine' => 'Site Vitrine',
            'blog' => 'Blog',
            'portfolio' => 'Portfolio',
            'saas' => 'SaaS',
            'corporate' => 'Corporate',
        ];
    }
}
