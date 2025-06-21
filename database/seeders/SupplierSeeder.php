<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert(
            [
                [
                    'name'       => 'EcoBuild NV',
                    'email'      => 'info@ecobuild.example',
                    'phone'      => '+32 3 555 0100',
                    'created_at' => now(),
                ],
                [
                    'name'       => 'GreenFuture Ltd',
                    'email'      => 'contact@greenfuture.example',
                    'phone'      => '+32 9 555 0200',
                    'created_at' => now(),
                ],
                [
                    'name'       => 'RePlanet BV',
                    'email'      => 'sales@replanet.example',
                    'phone'      => '+32 16 555 0300',
                    'created_at' => now(),
                ],
            ]
        );
    }
}
