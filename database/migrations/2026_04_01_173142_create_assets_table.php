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
        Schema::create('assets', function (Blueprint $table) {
                $table->id();
                $table->string('asset_name');
                $table->string('asset_code')->nullable();
                $table->string('asset_image')->nullable();

                $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('sub_category_id')->nullable()->constrained()->nullOnDelete();

                $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('sub_location_id')->nullable()->constrained()->nullOnDelete();

                $table->foreignId('status_id')->nullable()->constrained()->nullOnDelete();

                $table->string('cwip_invoice_id')->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
