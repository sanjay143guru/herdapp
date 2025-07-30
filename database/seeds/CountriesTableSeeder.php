<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name' => 'Germany', 'population' => 83100000],
            ['name' => 'France', 'population' => 67000000],
            // add more countries as needed
        ]);

    }
}
