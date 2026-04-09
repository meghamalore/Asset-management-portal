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
        Schema::create('schedule_activities', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();

            // Activity Info
            $table->string('activity_type')->nullable();
            $table->text('description')->nullable();
            $table->string('asset_category')->nullable();

            // Assignment
            $table->string('user_group')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();

            // Schedule
            $table->string('occurs')->nullable(); // daily, weekly, etc.
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Reminder
            $table->string('activity_reminder')->nullable();
            $table->string('email_based_on')->nullable();

            // Grace Period
            $table->string('grace_before')->nullable();
            $table->string('grace_after')->nullable();

            // CC
            $table->text('cc')->nullable();

            // Activity Details
            $table->string('vendor_name')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_activities');
    }
};
