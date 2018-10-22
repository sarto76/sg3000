<?php

use Illuminate\Database\Seeder;

class IncludesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Inclusion::class, 100)->create();
    }
}
