<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectConfiguration extends Model
{
    protected $fillable = [
        'project_id',
        'primary_color',
        'secondary_color',
        'accent_color',
        'domain_name',
        'design_style',
        'logo_path',
        'banner_path',
        'copywriting_brief',
        'contact_phone',
        'contact_email',
        'contact_address',
        'opening_hours',
        'form_types',
        'additional_options'
    ];

    protected $casts = [
        'form_types' => 'array',
        'additional_options' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
