<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->unique();

            $table->foreignId('visit_id')
                ->constrained('visits')->cascadeOnDelete();

            // Denormalized for fast finance querying (must match visit.patient_id)
            $table->foreignId('patient_id')
                ->constrained('patients')->cascadeOnDelete();

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->enum('status', ['unpaid', 'partial', 'paid', 'void'])
                ->default('unpaid');

            $table->dateTime('issued_at');

            $table->foreignId('issued_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['status', 'issued_at']);
            $table->index(['patient_id', 'issued_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
