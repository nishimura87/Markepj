<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Addressee;


class AddresseesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Addressee::factory()->count(10)->create();
    }
}
