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
        Schema::create('asset_purchase_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained()->cascadeOnDelete();

            $table->string('vendor_name')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('asset_po_number')->nullable();

            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 12, 2)->nullable();

            $table->boolean('is_self_owned')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_purchase_infos');
    }
};
