<?php

namespace App\Models;

use App\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use Commentable;

    protected $fillable = ['project_id', 'name', 'description', 'status', 'assigned_to', 'priority', 'due_date', 'category'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
