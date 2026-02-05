<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProjectType;
use App\Models\FeatureCategory;
use App\Models\Project;
use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Support\Str;

class ConfiguratorController extends Controller
{
    public function index()
    {
        $categories = Category::with('projectTypes')->get();
        $featureCategories = FeatureCategory::with('features')->get();

        return view('configurator.index', compact('categories', 'featureCategories'));
    }

    public function store(Request $request, QuoteService $quoteService)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_type_id' => 'required|exists:project_types,id',
            'features' => 'array',
            'features.*' => 'exists:features,id',
            'platforms' => 'array',
        ]);

        $type = ProjectType::findOrFail($request->project_type_id);
        $featureIds = $request->features ?? [];
        $secondaryPlatforms = $request->platforms ?? [];

        $calculation = $quoteService->calculate($type, $featureIds, $secondaryPlatforms);

        $project = Project::create([
            'user_id' => auth()->id(),
            'project_type_id' => $type->id,
            'name' => $request->project_name,
            'slug' => Str::slug($request->project_name) . '-' . Str::random(5),
            'preview_slug' => Str::random(8),
            'total_price' => $calculation['total_price'],
            'total_duration' => $calculation['total_duration'],
            'status' => 'new',
        ]);

        $project->features()->attach($featureIds);

        foreach ($calculation['additional_platforms'] as $platform) {
            $project->platforms()->create([
                'platform_type' => $platform['type'],
                'additional_price' => $platform['price'],
                'additional_duration' => $platform['duration'],
            ]);
        }

        $project->quote()->create([
            'reference' => 'QT-' . strtoupper(Str::random(6)),
            'deposit_amount' => $calculation['deposit'],
            'balance_amount' => $calculation['balance'],
            'status' => 'pending',
        ]);

        return redirect()->route('projects.show', $project);
    }

    public function show(Project $project)
    {
        $project->load(['projectType.category', 'features', 'quote', 'platforms']);

        return view('projects.show', compact('project'));
    }
}
