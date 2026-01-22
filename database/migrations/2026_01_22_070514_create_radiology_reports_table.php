<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('radiology_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_record_id')->constrained()->onDelete('cascade');
            $table->foreignId('radiologist_id')->constrained('users');
            $table->string('report_number')->unique(); // Auto-generated: REP-YYYY-MM-001
            $table->text('clinical_history')->nullable();
            $table->text('technique')->nullable();
            $table->text('findings');
            $table->text('impression');
            $table->text('recommendations')->nullable();
            $table->enum('priority', ['routine', 'urgent', 'stat'])->default('routine');
            $table->enum('status', ['draft', 'finalized', 'amended', 'cancelled'])->default('draft');
            $table->dateTime('finalized_at')->nullable();
            $table->text('amendment_notes')->nullable();
            $table->boolean('sent_to_patient')->default(false);
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('radiology_reports');
    }
};