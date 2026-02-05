<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPlatform extends Model
{
    protected $fillable = ['project_id', 'platform_type', 'additional_price', 'additional_duration'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
