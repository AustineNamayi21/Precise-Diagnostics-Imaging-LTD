<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // Optional clinic identifier (NOT the primary key)
            $table->string('patient_number')->nullable()->unique();

            $table->string('first_name');
            $table->string('last_name');

            $table->string('phone')->index();
            $table->string('email')->nullable()->index();

            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            $table->string('address')->nullable();

            // Who registered the patient (staff user)
            $table->foreignId('created_by')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
