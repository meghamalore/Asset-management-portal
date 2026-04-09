<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleActivityAssetsLink extends Model
{
    protected $table = 'schedule_activity_assets_links';
    protected $fillable = [
            'schedule_activity_id',
            'asset_id',
        ];
}
