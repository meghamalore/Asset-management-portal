<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_category_activity_schedules', function (Blueprint $table) {
            $table->id();
             $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            $table->string('assigned_based_on')->nullable(); // role/user/etc
            $table->string('user_type')->nullable();
            $table->string('assign_role')->nullable();
            $table->string('assignee')->nullable();

            $table->string('activity_type')->nullable();

            $table->string('occurs')->nullable(); // daily/weekly/monthly
            $table->integer('start_schedule_after_days')->nullable();

            $table->integer('activity_reminders')->nullable();

            $table->string('schedule_based_on')->nullable(); // fixed/custom
            $table->string('custom_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_category_activity_schedules');
    }
};
