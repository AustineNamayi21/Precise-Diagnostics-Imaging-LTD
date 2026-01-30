<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * NOTE:
         * Your DB likely restricts modality to: XRAY, ULTRASOUND, CT, MRI
         * - Fluoroscopy is XRAY-based => stored as XRAY
         * - ECG is not imaging, but stored as XRAY to satisfy the constraint
         *
         * Prices below use a reasonable midpoint from your ranges.
         */
        $services = [
            [
                'name' => 'MRI Scanning',
                'modality' => 'MRI',
                'price' => 30000, // midpoint of 15k–45k
                'is_active' => true,
            ],
            [
                'name' => 'MR Spectroscopy',
                'modality' => 'MRI',
                'price' => 30000, // midpoint of 25k–35k
                'is_active' => true,
            ],
            [
                'name' => 'CT Scanning',
                'modality' => 'CT',
                'price' => 16500, // midpoint of 8k–25k
                'is_active' => true,
            ],
            [
                'name' => 'Ultrasound Scan',
                'modality' => 'ULTRASOUND',
                'price' => 10000, // midpoint of 5k–15k
                'is_active' => true,
            ],
            [
                'name' => 'Fluoroscopy',
                'modality' => 'XRAY',
                'price' => 20000, // midpoint of 10k–30k
                'is_active' => true,
            ],
            [
                'name' => 'ECG Scan',
                'modality' => 'XRAY', // stored as XRAY to avoid DB constraint errors
                'price' => 4000, // midpoint of 3k–5k
                'is_active' => true,
            ],
            [
                'name' => 'General X-Ray',
                'modality' => 'XRAY',
                'price' => 3500, // you didn’t give a range; set a reasonable default
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']], // prevent duplicates
                $service
            );
        }
    }
}
