<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $projectTypes = ProjectType::with('category')->get();
        $categories = Category::all();
        return view('admin.project-types.index', compact('projectTypes', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric|min:0',
            'base_duration_days' => 'required|numeric|min:1',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['name']);

        ProjectType::create($data);

        return redirect()->back()->with('success', 'Nouveau type de projet créé.');
    }

    public function show(ProjectType $projectType)
    {
        $projectType->load('category');
        return view('admin.project-types.show', compact('projectType'));
    }

    public function edit(ProjectType $projectType)
    {
        $categories = Category::all();
        return view('admin.project-types.edit', compact('projectType', 'categories'));
    }

    public function update(Request $request, ProjectType $projectType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'base_duration_days' => 'required|numeric|min:1',
        ]);

        $projectType->update($data);
        return redirect()->back()->with('success', 'Type mis à jour.');
    }

    public function destroy(ProjectType $projectType)
    {
        $projectType->delete();
        return redirect()->back()->with('success', 'Type supprimé.');
    }
}