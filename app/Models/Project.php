<?php

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Commentable;

    protected $fillable = ['user_id', 'developer_id', 'project_manager_id', 'community_manager_id', 'project_type_id', 'name', 'slug', 'preview_slug', 'total_price', 'total_duration', 'status', 'deployment_url', 'staging_url', 'demo_files', 'developer_notes'];

    protected $casts = [
        'demo_files' => 'array',
        'developer_notes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function projectManager()
    {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function communityManager()
    {
        return $this->belongsTo(User::class, 'community_manager_id');
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

    public function deliverables()
    {
        return $this->hasMany(Deliverable::class);
    }

    public function configuration()
    {
        return $this->hasOne(ProjectConfiguration::class);
    }
}
