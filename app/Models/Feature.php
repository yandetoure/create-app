<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['feature_category_id', 'name', 'slug', 'description', 'price', 'impact_days', 'component_name', 'is_default', 'is_base'];

    public function featureCategory()
    {
        return $this->belongsTo(FeatureCategory::class);
    }

    public function category()
    {
        return $this->featureCategory();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
