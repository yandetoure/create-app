<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coreFeatures = \App\Models\CoreFeature::latest()->get();
        return view('admin.core-features.index', compact('coreFeatures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.core-features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        \App\Models\CoreFeature::create($validated);

        return redirect()->route('admin.core-features.index')
            ->with('success', 'Fonctionnalité de base créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\CoreFeature $coreFeature)
    {
        return view('admin.core-features.edit', compact('coreFeature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\CoreFeature $coreFeature)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $coreFeature->update($validated);

        return redirect()->route('admin.core-features.index')
            ->with('success', 'Fonctionnalité de base mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\CoreFeature $coreFeature)
    {
        $coreFeature->delete();

        return redirect()->route('admin.core-features.index')
            ->with('success', 'Fonctionnalité de base supprimée avec succès.');
    }

    /**
     * Toggle the active status of a core feature.
     */
    public function toggleStatus(\App\Models\CoreFeature $coreFeature)
    {
        $coreFeature->update(['is_active' => !$coreFeature->is_active]);

        return redirect()->route('admin.core-features.index')
            ->with('success', 'Statut mis à jour avec succès.');
    }
}
