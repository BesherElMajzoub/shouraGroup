<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class JobApplication extends Model
{
    protected $fillable = [
        'full_name', 'phone', 'email', 'department',
        'preferred_branch', 'cover_letter', 'cv_path', 'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected function cvUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->cv_path ? asset('storage/' . $this->cv_path) : null
        );
    }
}
