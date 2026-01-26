<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('invoices')->cascadeOnDelete();

            // Optional link back to the performed imaging service (line item)
            $table->foreignId('imaging_service_id')->nullable()
                ->constrained('imaging_services')->nullOnDelete();

            $table->string('description');

            $table->unsignedInteger('quantity')->default(1);

            $table->decimal('unit_price', 12, 2);
            $table->decimal('line_total', 12, 2);

            $table->timestamps();

            $table->index(['invoice_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
