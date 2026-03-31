<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetCategoryActivitySchedule extends Model
{
    protected $table = 'asset_category_activity_schedules';
    protected $fillable = [
        'category_id',
        'assigned_based_on',
        'user_type',
        'assign_role',
        'assignee',
        'activity_type',
        'occurs',
        'start_schedule_after_days',
        'activity_reminders',
        'schedule_based_on',
        'custom_days',
    ];
}
