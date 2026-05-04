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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->nullable(); // Optional auto-generated
            $table->unsignedBigInteger('parent_ticket')->nullable();

            $table->foreignId('ticket_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_status_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');

            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('asset_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();

            $table->unsignedBigInteger('assigned_to')->nullable(); // user id
            $table->string('ticket_group')->nullable();

            $table->enum('priority', ['low', 'medium', 'high'])->default('low');

            $table->date('reported_date')->nullable();
            $table->unsignedBigInteger('reported_by')->nullable(); // user id

            $table->text('description')->nullable();

            $table->boolean('notify_reported_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
