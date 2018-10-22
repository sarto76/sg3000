<?php

use Illuminate\Database\Seeder;

class LicenseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LicenseType::class, 100)->create();
    }
}
