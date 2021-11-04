<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!DB::table('cities')->count()) {
            DB::unprepared(file_get_contents(__DIR__ . '/sql/philippine_cities.sql'));
        }
    }
}
