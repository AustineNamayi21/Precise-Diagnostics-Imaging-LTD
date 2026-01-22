<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->time('visit_time');
            $table->enum('visit_type', ['consultation', 'imaging', 'follow_up', 'emergency']);
            $table->string('reason_for_visit');
            $table->foreignId('radiographer_id')->constrained('users');
            $table->text('clinical_notes')->nullable();
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid', 'partial'])->default('pending');
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_visits');
    }
};