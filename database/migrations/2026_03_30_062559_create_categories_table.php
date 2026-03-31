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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->boolean('is_inventory')->default(0);
            $table->boolean('is_asset_link')->default(0);

            $table->string('category_code')->nullable();

            $table->integer('trafs_duration')->nullable();
            $table->enum('trafs_duration_type', ['day', 'month', 'year'])->nullable();

            $table->boolean('cascade')->default(0);
            $table->boolean('auto_extended')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
