<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function show(Request $request, $slug)
    {
        $project = Project::where('preview_slug', $slug)
            ->with(['projectType.category', 'features', 'configuration'])
            ->firstOrFail();

        $page = $request->query('page', 'home');
        $category = $project->projectType->category->slug;

        $components = $project->features
            ->whereNotNull('component_name')
            ->pluck('component_name')
            ->unique()
            ->toArray();

        // Specific logic for E-commerce
        $mockData = [];
        if ($category === 'e-commerce') {
            $mockData['products'] = [
                ['id' => 1, 'name' => 'Produit Premium A', 'price' => '25.000', 'image' => 'https://picsum.photos/seed/p1/400/400'],
                ['id' => 2, 'name' => 'Pack Découverte', 'price' => '12.500', 'image' => 'https://picsum.photos/seed/p2/400/400'],
                ['id' => 3, 'name' => 'Édition Spéciale', 'price' => '45.000', 'image' => 'https://picsum.photos/seed/p3/400/400'],
                ['id' => 4, 'name' => 'Accessoire Pro', 'price' => '8.000', 'image' => 'https://picsum.photos/seed/p4/400/400'],
            ];
        }

        // Add defaults if not present
        if (!in_array('hero', $components))
            array_unshift($components, 'hero');
        if (!in_array('contact', $components))
            $components[] = 'contact';

        return view('preview.show', [
            'project' => $project,
            'components' => $components,
            'isMobile' => $category === 'app-mobile',
            'page' => $page,
            'category' => $category,
            'mockData' => $mockData
        ]);
    }
}
