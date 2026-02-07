<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Template extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'project_type_id',
        'category',
        'preview_image',
        'thumbnail_image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($template) {
            if (empty($template->slug)) {
                $template->slug = Str::slug($template->name);
            }
        });
    }

    // Relationships
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class, 'template_components')
            ->withPivot('section_name', 'sort_order', 'default_settings')
            ->withTimestamps()
            ->orderBy('template_components.sort_order');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function customizations()
    {
        return $this->hasMany(ProjectTemplateCustomization::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByProjectType($query, $projectTypeId)
    {
        return $query->where('project_type_id', $projectTypeId);
    }

    // Helper methods
    public function getComponentsBySection($sectionName)
    {
        return $this->components()->wherePivot('section_name', $sectionName)->get();
    }
}
