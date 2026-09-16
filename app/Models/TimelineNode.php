<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

class TimelineNode extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['title', 'description'];

    protected $fillable = ['event_date', 'title', 'title_en', 'description', 'description_en', 'order'];

    protected $casts = [
        'order' => 'integer',
    ];
}
