<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureCategory;
use Illuminate\Http\Request;

class FeatureCategoryController extends Controller
{
    public function index()
    {
        $categories = FeatureCategory::withCount('features')->get();
        return view('admin.feature-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        FeatureCategory::create($validated);

        return redirect()->route('admin.feature-categories.index')->with('success', 'Catégorie de fonctionnalité créée.');
    }

    public function edit(FeatureCategory $featureCategory)
    {
        return view('admin.feature-categories.edit', compact('featureCategory'));
    }

    public function update(Request $request, FeatureCategory $featureCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $featureCategory->update($validated);

        return redirect()->route('admin.feature-categories.index')->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(FeatureCategory $featureCategory)
    {
        $featureCategory->delete();
        return redirect()->route('admin.feature-categories.index')->with('success', 'Catégorie supprimée.');
    }
}
