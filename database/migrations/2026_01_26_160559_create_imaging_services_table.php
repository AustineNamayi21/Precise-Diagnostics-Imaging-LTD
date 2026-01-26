<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('imaging_services', function (Blueprint $table) {
            $table->id();

            // The visit (encounter header)
            $table->foreignId('visit_id')
                ->constrained('visits')->cascadeOnDelete();

            // Procedure from the catalog (services)
            $table->foreignId('service_id')
                ->constrained('services')->restrictOnDelete();

            $table->dateTime('ordered_at')->nullable();
            $table->dateTime('performed_at')->nullable();

            // Radiographer who performed the exam (staff)
            $table->foreignId('radiographer_id')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->text('notes')->nullable();

            $table->enum('status', ['ordered', 'performed', 'reported', 'delivered', 'cancelled'])
                ->default('ordered');

            // If price differs from catalog price
            $table->decimal('price_override', 12, 2)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['visit_id']);
            $table->index(['service_id']);
            $table->index(['status', 'performed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imaging_services');
    }
};
