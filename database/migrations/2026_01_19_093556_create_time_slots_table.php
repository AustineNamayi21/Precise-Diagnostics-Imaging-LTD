<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->date('slot_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('radiologist_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('slot_type', ['available', 'booked', 'blocked', 'emergency'])->default('available');
            $table->integer('max_appointments')->default(1);
            $table->integer('booked_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['slot_date', 'start_time', 'service_id', 'radiologist_id']);
            $table->index(['slot_date', 'slot_type']);
            $table->index(['service_id', 'slot_date', 'is_active']);
            $table->index(['radiologist_id', 'slot_date', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_slots');
    }
};