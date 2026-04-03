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
        Schema::create('asset_warranty_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->string('amc_vendor')->nullable();
            $table->string('warranty_vendor')->nullable();

            $table->date('insurance_start_date')->nullable();
            $table->date('insurance_end_date')->nullable();

            $table->date('amc_start_date')->nullable();
            $table->date('amc_end_date')->nullable();

            $table->date('warranty_start_date')->nullable();
            $table->date('warranty_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_warranty_infos');
    }
};
