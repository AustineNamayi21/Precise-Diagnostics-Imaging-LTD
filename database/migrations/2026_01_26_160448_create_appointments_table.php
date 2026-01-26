<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->string('appointment_number')->unique();

            // Booking details (public website)
            $table->string('patient_name');
            $table->string('patient_email')->nullable();
            $table->string('patient_phone');
            $table->date('patient_dob')->nullable();

            // Procedure requested
            $table->foreignId('service_id')->nullable()
                ->constrained('services')->nullOnDelete();

            // Snapshot of service name at booking time
            $table->string('service_name');

            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'])
                ->default('pending');

            $table->enum('priority', ['routine', 'urgent', 'emergency'])
                ->default('routine');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['appointment_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
