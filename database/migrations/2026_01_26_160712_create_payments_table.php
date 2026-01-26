<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('invoices')->cascadeOnDelete();

            $table->decimal('amount', 12, 2);

            $table->enum('method', ['cash', 'mpesa', 'card', 'bank'])
                ->default('cash');

            $table->string('reference')->nullable();

            $table->dateTime('paid_at');

            $table->foreignId('received_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->index(['paid_at']);
            $table->index(['method', 'paid_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
