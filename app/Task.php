<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    
    protected $dates = [
        'completed_at'
    ];

    protected $appends = [
        'complete'
    ];

    public function getCompleteAttribute(): bool
    {
        return $this->completed_at != null;
    }
}
