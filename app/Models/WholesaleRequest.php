<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WholesaleRequest extends Model
{
    protected $fillable = [
        'name', 'phone', 'product_interest', 'governorate', 'address', 'message', 'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
