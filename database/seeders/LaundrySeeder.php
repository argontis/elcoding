<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaundryOrder;
use App\Models\LaundryCustomer;
use App\Models\LaundryService;

class LaundrySeeder extends Seeder
{
    /**
     * Seed L-Clean Laundry Services catalog & clear initial orders and customers for fresh data entry.
     */
    public function run(): void
    {
        // 1. Clear existing orders and customers for fresh operational data
        LaundryOrder::query()->delete();
        LaundryCustomer::query()->delete();

        // 2. Seed Laundry Services Catalog (Tarif POS)
        $services = [
            [
                'name' => 'Cuci Lipat Reguler (2 Hari)',
                'tier' => 'Kiloan',
                'price_formatted' => 'Rp 7.000 / kg',
                'price_amount' => 7000.00,
                'unit' => 'kg',
                'minimum_batch' => '3 kg min',
                'hardware_spec' => 'Mesin Cuci Front Loading 12kg',
                'status' => 'Active',
            ],
            [
                'name' => 'Cuci Setrika Express (6 Jam)',
                'tier' => 'Express Kiloan',
                'price_formatted' => 'Rp 14.000 / kg',
                'price_amount' => 14000.00,
                'unit' => 'kg',
                'minimum_batch' => '2 kg min',
                'hardware_spec' => 'Dryer High-Temp + Steam Iron Station',
                'status' => 'Active',
            ],
            [
                'name' => 'Dry Cleaning Jas / Stelan',
                'tier' => 'Dry Clean Satuan',
                'price_formatted' => 'Rp 45.000 / pcs',
                'price_amount' => 45000.00,
                'unit' => 'pcs',
                'minimum_batch' => '1 pcs min',
                'hardware_spec' => 'K-Hydrocarbon Eco Solvent Unit',
                'status' => 'Active',
            ],
            [
                'name' => 'Cuci Karpet & Bed Cover',
                'tier' => 'Specialist Satuan',
                'price_formatted' => 'Rp 35.000 / pcs',
                'price_amount' => 35000.00,
                'unit' => 'pcs',
                'minimum_batch' => '1 pcs min',
                'hardware_spec' => 'Spinner Extra Large + Anti-Bakteri UV',
                'status' => 'Active',
            ],
            [
                'name' => 'Laundry Sepatu & Tas Premium',
                'tier' => 'Specialist Satuan',
                'price_formatted' => 'Rp 50.000 / pcs',
                'price_amount' => 50000.00,
                'unit' => 'pcs',
                'minimum_batch' => '1 pcs min',
                'hardware_spec' => 'Ultrasonic Cleaner + Leather Conditioner',
                'status' => 'Active',
            ],
            [
                'name' => 'Linen Hotel & Resto (Steril)',
                'tier' => 'Komersial / Bulk',
                'price_formatted' => 'Rp 8.500 / kg',
                'price_amount' => 8500.00,
                'unit' => 'kg',
                'minimum_batch' => '20 kg min',
                'hardware_spec' => 'Continuous Tunnel Washer',
                'status' => 'Active',
            ],
        ];

        foreach ($services as $srv) {
            LaundryService::updateOrCreate(
                ['name' => $srv['name']],
                $srv
            );
        }
    }
}
