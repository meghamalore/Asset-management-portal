<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFinacialInformation extends Model
{
    protected $table = 'category_finacial_information';
    protected $fillable = [
        'category_id',
        'end_of_life',
        'end_of_life_type',
        'scrap_value',
        'scrap_value_type',
        'depreciation',
        'income_tax_depreciation',
    ];
}
