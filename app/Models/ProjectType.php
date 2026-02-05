<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'base_price', 'base_duration_days'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_project_type')->withTimestamps();
    }
}
