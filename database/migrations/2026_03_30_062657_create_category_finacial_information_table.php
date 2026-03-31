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
        Schema::create('category_finacial_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();

            $table->integer('end_of_life')->nullable();
            $table->enum('end_of_life_type', ['day', 'month', 'year'])->nullable();

            $table->decimal('scrap_value', 10, 2)->nullable();
            $table->string('scrap_value_type')->nullable();

            $table->decimal('depreciation', 5, 2)->nullable();
            $table->decimal('income_tax_depreciation', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_finacial_information');
    }
};
