<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Shipping::factory(10)->create();
    }
}
