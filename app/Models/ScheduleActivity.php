<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleActivity extends Model
{
    protected $table = 'schedule_activities';
    protected $fillable = [
            'location',
            'activity_type',
            'description',
            'asset_category',
            'user_group',
            'assigned_to',
            'occurs',
            'start_date',
            'end_date',
            'activity_reminder',
            'email_based_on',
            'grace_before',
            'grace_after',
            'cc',
            'vendor_name',
            'amount',
        ];
}
