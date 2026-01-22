<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imaging_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_code')->unique(); // Example: XRAY-CHEST, MRI-BRAIN
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('modality', ['xray', 'ct', 'mri', 'ultrasound', 'mammography', 'fluoroscopy']);
            $table->string('body_part')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration_minutes')->default(30);
            $table->text('preparation_instructions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imaging_services');
    }
};