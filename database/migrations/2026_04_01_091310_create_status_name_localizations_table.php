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
        Schema::create('status_name_localizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses')->cascadeOnDelete();
            $table->string('status_name');
            $table->string('language'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_name_localizations');
    }
};
