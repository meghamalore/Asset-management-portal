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
        Schema::create('asset_finacial_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->decimal('capitalization_price', 12, 2)->nullable();
            $table->date('capitalization_date')->nullable();

            $table->decimal('depreciation_percent', 5, 2)->nullable();
            $table->decimal('accumulated_depreciation', 12, 2)->nullable();

            $table->decimal('scrap_value', 12, 2)->nullable();
            $table->decimal('income_tax_depreciation_percent', 5, 2)->nullable();

            $table->date('end_of_life')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_finacial_infos');
    }
};
