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
        Schema::create('asset_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('from_location_id')->nullable();
            $table->unsignedBigInteger('to_location_id')->nullable();
            $table->unsignedBigInteger('from_sub_location_id')->nullable();
            $table->unsignedBigInteger('to_sub_location_id')->nullable();
            $table->string('transfer_status')->nullable();
            $table->string('transferred_to')->nullable();
            $table->date('allotted_upto')->nullable();
            $table->string('transfer_cc')->nullable();
            $table->text('remarks')->nullable();
            $table->string('file_paths')->nullable(); // Store JSON or comma-separated paths
            $table->unsignedBigInteger('transferred_by')->nullable();
            $table->timestamp('transferred_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_transfers');
    }
};
