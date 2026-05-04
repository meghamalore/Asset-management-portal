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
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();

            $table->string('ticket_type');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('expected_tat')->nullable();

            $table->enum('activity_type', ['calibration', 'inspection', 'warranty_expiry'])->nullable();
            $table->enum('duration_type', ['day', 'hours', 'minutes'])->default('day');

            $table->text('reason')->nullable();
            $table->foreignId('location_id')->nullable()->constrained()->onDelete('set null');

            $table->enum('role_type', ['user_involved', 'user_role'])->nullable();

            $table->string('reopen_allowed')->nullable(); // 24,48,72,custom

            $table->boolean('otp_required')->default(false);
            $table->boolean('generate_email')->default(false);
            $table->boolean('change_asset_status')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};
