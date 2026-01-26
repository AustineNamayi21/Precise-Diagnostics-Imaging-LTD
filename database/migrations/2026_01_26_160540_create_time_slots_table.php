<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services')->cascadeOnDelete();

            $table->date('slot_date');
            $table->time('slot_time');

            $table->boolean('is_available')->default(true);

            $table->timestamps();

            // Prevent duplicate time slots for the same service
            $table->unique(['service_id', 'slot_date', 'slot_time']);
            $table->index(['slot_date', 'is_available']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
