<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_visit_id')->constrained()->onDelete('cascade');
            $table->foreignId('imaging_service_id')->constrained();
            $table->foreignId('radiologist_id')->nullable()->constrained('users');
            $table->dateTime('service_date');
            $table->text('technician_notes')->nullable();
            $table->string('image_files_path')->nullable(); // Store path to uploaded images
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_records');
    }
};