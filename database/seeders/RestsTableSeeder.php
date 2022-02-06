<?php

namespace Database\Seeders;

use App\Models\Rest;
use Illuminate\Database\Seeder;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rest::factory()->count(5)->create();
    }
}
