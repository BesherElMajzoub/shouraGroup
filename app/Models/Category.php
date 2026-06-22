<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['type', 'name', 'slug', 'order'];

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
