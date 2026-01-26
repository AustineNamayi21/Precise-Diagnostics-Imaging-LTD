<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('patients')->cascadeOnDelete();

            // Optional: link visit back to a booking
            $table->foreignId('appointment_id')->nullable()
                ->constrained('appointments')->nullOnDelete();

            $table->date('visit_date');
            $table->time('visit_time')->nullable();

            $table->enum('visit_type', ['imaging', 'follow_up', 'consult'])
                ->default('imaging');

            $table->text('reason_for_visit')->nullable();
            $table->text('clinical_notes')->nullable();

            $table->enum('status', ['scheduled', 'checked_in', 'in_progress', 'completed', 'cancelled'])
                ->default('scheduled');

            // Who created the visit (staff)
            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['patient_id', 'visit_date']);
            $table->index(['status', 'visit_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
