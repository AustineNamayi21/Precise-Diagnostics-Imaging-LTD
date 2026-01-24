<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Check if table exists before creating
        if (!Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code')->unique();
                $table->string('category')->default('diagnostic');
                $table->text('description')->nullable();
                $table->integer('duration_minutes')->default(30);
                $table->decimal('price', 10, 2);
                $table->decimal('discounted_price', 10, 2)->nullable();
                $table->boolean('is_active')->default(true);
                $table->text('preparation_instructions')->nullable();
                $table->text('post_procedure_care')->nullable();
                $table->text('insurance_coverage')->nullable();
                $table->text('contraindications')->nullable();
                $table->string('icon_class')->default('fas fa-stethoscope');
                $table->integer('display_order')->default(0);
                $table->integer('slot_buffer_minutes')->default(15);
                $table->boolean('requires_radiologist')->default(true);
                $table->boolean('requires_fasting')->default(false);
                $table->integer('advance_booking_days')->default(30);
                $table->integer('cancellation_hours')->default(24);
                $table->timestamps();
            });
            
            echo "Services table created successfully.\n";
        } else {
            echo "Services table already exists. Skipping creation.\n";
        }
        
        // Check if we need to insert default services
        // Only insert if the table is empty
        if (Schema::hasTable('services') && DB::table('services')->count() === 0) {
            DB::table('services')->insert([
                [
                    'name' => 'MRI Scanning',
                    'code' => 'MRI-001',
                    'category' => 'advanced',
                    'description' => 'Magnetic Resonance Imaging for detailed internal body structure visualization',
                    'duration_minutes' => 60,
                    'price' => 25000.00,
                    'discounted_price' => 22000.00,
                    'icon_class' => 'fas fa-mri',
                    'display_order' => 1,
                    'slot_buffer_minutes' => 30,
                    'requires_fasting' => true,
                    'requires_radiologist' => true,
                    'advance_booking_days' => 30,
                    'cancellation_hours' => 24,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'CT Scanning',
                    'code' => 'CT-001',
                    'category' => 'advanced',
                    'description' => 'Computed Tomography scan for cross-sectional imaging',
                    'duration_minutes' => 30,
                    'price' => 15000.00,
                    'discounted_price' => 13000.00,
                    'icon_class' => 'fas fa-ct-scan',
                    'display_order' => 2,
                    'slot_buffer_minutes' => 15,
                    'requires_fasting' => false,
                    'requires_radiologist' => true,
                    'advance_booking_days' => 30,
                    'cancellation_hours' => 24,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Ultrasound Scan',
                    'code' => 'US-001',
                    'category' => 'diagnostic',
                    'description' => 'Ultrasound imaging for soft tissue examination',
                    'duration_minutes' => 30,
                    'price' => 8000.00,
                    'discounted_price' => 7000.00,
                    'icon_class' => 'fas fa-ultrasound',
                    'display_order' => 3,
                    'slot_buffer_minutes' => 15,
                    'requires_fasting' => false,
                    'requires_radiologist' => true,
                    'advance_booking_days' => 30,
                    'cancellation_hours' => 24,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'General X-Ray',
                    'code' => 'XRAY-001',
                    'category' => 'basic',
                    'description' => 'Standard X-ray imaging for bone and chest examination',
                    'duration_minutes' => 20,
                    'price' => 3000.00,
                    'discounted_price' => 2500.00,
                    'icon_class' => 'fas fa-x-ray',
                    'display_order' => 4,
                    'slot_buffer_minutes' => 15,
                    'requires_fasting' => false,
                    'requires_radiologist' => true,
                    'advance_booking_days' => 30,
                    'cancellation_hours' => 24,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            
            echo "Default services inserted successfully.\n";
        } else {
            echo "Services table already has data. Skipping insertion.\n";
        }
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};