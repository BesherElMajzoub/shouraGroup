<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineNode extends Model
{
    protected $fillable = ['event_date', 'title', 'description', 'order'];

    protected $casts = [
        'order' => 'integer',
    ];
}
