<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['name'];

    protected $fillable = ['type', 'name', 'name_en', 'slug', 'order'];

    protected $casts = [
        'order' => 'integer',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class)->orderBy('order');
    }

    public function news()
    {
        return $this->hasMany(News::class)->orderBy('order');
    }
}
