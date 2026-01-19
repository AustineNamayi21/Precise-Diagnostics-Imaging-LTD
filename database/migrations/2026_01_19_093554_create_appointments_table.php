<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_number')->unique();
            $table->foreignId('patient_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('patient_name');
            $table->string('patient_email')->nullable();
            $table->string('patient_phone');
            $table->date('patient_dob')->nullable();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('service_name');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'])->default('pending');
            $table->enum('priority', ['routine', 'urgent', 'emergency'])->default('routine');
            $table->text('reason')->nullable();
            $table->string('insurance_provider')->nullable();
            $table->json('contact_preferences')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('final_cost', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('radiologist_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('room_assigned')->nullable();
            $table->integer('duration_minutes')->default(30);
            $table->string('referral_source')->nullable();
            $table->string('referring_doctor')->nullable();
            $table->boolean('is_walkin')->default(false);
            $table->boolean('has_previous_records')->default(false);
            $table->json('attachments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['appointment_date', 'status']);
            $table->index(['patient_phone', 'status']);
            $table->index(['service_id', 'appointment_date']);
            $table->index(['radiologist_id', 'appointment_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};