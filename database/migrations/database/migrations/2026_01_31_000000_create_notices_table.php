<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id('notice_id'); // ✅ matches your preferred {table}_id pattern

            $table->string('title')->nullable();
            $table->text('message');

            $table->enum('level', ['info', 'success', 'warning', 'danger'])->default('info');
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
