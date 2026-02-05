<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'developer_id', 'project_type_id', 'name', 'slug', 'preview_slug', 'total_price', 'total_duration', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function quote()
    {
        return $this->hasOne(Quote::class);
    }

    public function platforms()
    {
        return $this->hasMany(ProjectPlatform::class);
    }
}
