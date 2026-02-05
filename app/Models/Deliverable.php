<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
    protected $fillable = ['project_id', 'type', 'label', 'url', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
