<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryLocalization extends Model
{
    protected $table = 'category_localizations';
    protected $fillable = [
        'category_id',
        'category_name',
        'language',
    ];
}
