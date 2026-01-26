<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('radiology_reports', function (Blueprint $table) {
            $table->id();

            // One report per performed imaging service
            $table->foreignId('imaging_service_id')
                ->constrained('imaging_services')->cascadeOnDelete();

            // Typed report content (optional)
            $table->longText('report_text')->nullable();

            // Attachment (PDF/DOC/DOCX)
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('attachment_mime')->nullable();
            $table->unsignedBigInteger('attachment_size')->nullable();

            $table->enum('status', ['draft', 'final'])->default('draft');

            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->foreignId('finalized_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->dateTime('finalized_at')->nullable();

            $table->timestamps();

            // Enforce 1:1 (one report per imaging service)
            $table->unique('imaging_service_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_reports');
    }
};
