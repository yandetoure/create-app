<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\FeatureCategory;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::with('category')->get();
        $paidFeatures = $features->where('is_base', false);
        $baseFeatures = $features->where('is_base', true);
        $categories = FeatureCategory::all();

        return view('admin.features.index', compact('paidFeatures', 'baseFeatures', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'feature_category_id' => 'required|exists:feature_categories,id',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'base_duration' => 'required|numeric|min:0',
            'is_base' => 'boolean',
        ]);

        Feature::create([
            'name' => $validated['name'],
            'slug' => \Illuminate\Support\Str::slug($validated['name']),
            'feature_category_id' => $validated['feature_category_id'],
            'description' => $validated['description'],
            'price' => $validated['base_price'],
            'impact_days' => $validated['base_duration'],
            'is_base' => $request->has('is_base'),
        ]);

        return redirect()->back()->with('success', 'Nouvelle fonctionnalité ajoutée.');
    }

    public function show(Feature $feature)
    {
        $feature->load('category');
        return view('admin.features.show', compact('feature'));
    }

    public function edit(Feature $feature)
    {
        $categories = FeatureCategory::all();
        return view('admin.features.edit', compact('feature', 'categories'));
    }

    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'base_price' => 'required|numeric|min:0',
            'base_duration' => 'required|numeric|min:0',
        ]);

        $feature->update([
            'price' => $validated['base_price'],
            'impact_days' => $validated['base_duration'],
            'is_base' => $request->has('is_base'),
        ]);

        return redirect()->route('admin.features.index')->with('success', 'Fonctionnalité mise à jour.');
    }

    public function toggleBase(Feature $feature)
    {
        $feature->update(['is_base' => !$feature->is_base]);
        return redirect()->back()->with('success', 'Statut de "Base" mis à jour.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->back()->with('success', 'Fonctionnalité supprimée.');
    }
}