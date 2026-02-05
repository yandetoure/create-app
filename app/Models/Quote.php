<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['project_id', 'reference', 'deposit_amount', 'balance_amount', 'file_path', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
