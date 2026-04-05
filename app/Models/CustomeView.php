<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomeView extends Model
{
    protected $fillable = [
        'view_name',
        'columns',
        'is_default',
        'is_private',
        'role_id'
    ];

    protected $casts = [
        'columns' => 'array',
        'is_default' => 'boolean',
        'is_private' => 'boolean',
    ];
}
