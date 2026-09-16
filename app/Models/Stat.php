<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['label'];

    protected $fillable = ['value', 'label', 'label_en', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
