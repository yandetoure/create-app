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
        $categories = FeatureCategory::all();
        return view('admin.features.index', compact('features', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'feature_category_id' => 'required|exists:feature_categories,id',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'base_duration' => 'required|numeric|min:1',
        ]);

        Feature::create($data);

        return redirect()->back()->with('success', 'Nouvelle fonctionnalité ajoutée.');
    }

    public function update(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'base_duration' => 'required|numeric|min:1',
        ]);

        $feature->update($data);
        return redirect()->back()->with('success', 'Fonctionnalité mise à jour.');
    }

    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->back()->with('success', 'Fonctionnalité supprimée.');
    }
}