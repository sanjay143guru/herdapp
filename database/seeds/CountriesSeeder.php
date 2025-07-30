<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name' => 'Germany', 'population' => 83166711],
            ['name' => 'France', 'population' => 67391582],
            // Add all countries from the continent data file
        ]);
    }

}
