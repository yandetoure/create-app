<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComponentController extends Controller
{
    public function index(Request $request)
    {
        $query = Component::query();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $components = $query->orderBy('type')->orderBy('name')->paginate(30);
        $types = Component::getTypes();

        return view('admin.components.index', compact('components', 'types'));
    }

    public function create()
    {
        $types = Component::getTypes();
        return view('admin.components.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|max:2048',
            'html_code' => 'nullable|string',
            'css_code' => 'nullable|string',
            'js_code' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('components/previews', 'public');
        }

        Component::create($validated);

        return redirect()->route('admin.components.index')->with('success', 'Composant créé avec succès !');
    }

    public function show(Component $component)
    {
        $component->load('templates');
        return view('admin.components.show', ['comp' => $component]);
    }

    public function edit(Component $component)
    {
        $types = Component::getTypes();
        return view('admin.components.edit', ['comp' => $component, 'types' => $types]);
    }

    public function update(Request $request, Component $component)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'preview_image' => 'nullable|image|max:2048',
            'html_code' => 'nullable|string',
            'css_code' => 'nullable|string',
            'js_code' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('preview_image')) {
            $validated['preview_image'] = $request->file('preview_image')->store('components/previews', 'public');
        }

        $component->update($validated);

        return redirect()->route('admin.components.show', $component)->with('success', 'Composant mis à jour !');
    }

    public function destroy(Component $component)
    {
        $component->delete();
        return redirect()->route('admin.components.index')->with('success', 'Composant supprimé !');
    }
}
