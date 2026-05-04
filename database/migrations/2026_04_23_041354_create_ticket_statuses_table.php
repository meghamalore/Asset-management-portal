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
        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();
            
            $table->string('status')->nullable();
            
            $table->integer('auto_close_hours')->nullable();

            $table->boolean('is_default')->default(false);

            $table->string('edit_based_on')->nullable(); // user_involved / user_role

            $table->boolean('auto_checkout')->default(false);

            $table->boolean('tat_count')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_statuses');
    }
};
