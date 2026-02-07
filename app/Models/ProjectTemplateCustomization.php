<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTemplateCustomization extends Model
{
    protected $fillable = [
        'project_id',
        'template_id',
        'primary_color',
        'secondary_color',
        'accent_color',
        'font_heading',
        'font_body',
        'logo_url',
        'custom_components',
        'custom_images',
    ];

    protected $casts = [
        'custom_components' => 'array',
        'custom_images' => 'array',
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    // Helper methods
    public function getComponentForSection($sectionName)
    {
        return $this->custom_components[$sectionName] ?? null;
    }

    public function setComponentForSection($sectionName, $componentId)
    {
        $components = $this->custom_components ?? [];
        $components[$sectionName] = $componentId;
        $this->custom_components = $components;
        $this->save();
    }

    public function getColorPalette()
    {
        return [
            'primary' => $this->primary_color,
            'secondary' => $this->secondary_color,
            'accent' => $this->accent_color,
        ];
    }

    public function getFonts()
    {
        return [
            'heading' => $this->font_heading,
            'body' => $this->font_body,
        ];
    }
}
