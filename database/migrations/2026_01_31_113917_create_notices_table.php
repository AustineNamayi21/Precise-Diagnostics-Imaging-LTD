<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id(); // notices.id

            $table->string('title')->nullable();
            $table->text('message');

            // Info level for UI styling
            $table->enum('level', ['info', 'success', 'warning', 'danger'])
                  ->default('info');

            // Dashboard behaviour
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_active')->default(true);

            // Admin who created the notice
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
