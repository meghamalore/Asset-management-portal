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
        Schema::create('asset_disposal_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_disposal_id')->constrained()->cascadeOnDelete();

            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->decimal('sold_value', 12, 2)->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->decimal('price_difference', 12, 2)->nullable();

            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('sub_location_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_disposal_items');
    }
};
