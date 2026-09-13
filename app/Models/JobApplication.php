<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'full_name', 'phone', 'email', 'department',
        'preferred_branch', 'cover_letter', 'cv_path', 'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
