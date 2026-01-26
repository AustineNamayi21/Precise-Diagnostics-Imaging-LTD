<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('report_deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('radiology_report_id')
                ->constrained('radiology_reports')->cascadeOnDelete();

            $table->string('sent_to_email');

            $table->foreignId('sent_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->dateTime('sent_at');

            $table->enum('status', ['sent', 'failed']);

            $table->text('error_message')->nullable();

            $table->timestamps();

            $table->index(['status', 'sent_at']);
            $table->index(['radiology_report_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_deliveries');
    }
};
