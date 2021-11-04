<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['poll_items', 'polls', 'stations', 'contacts', 'candidates'];

    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();

        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

//        $this->call(PhilippineRegionsTableSeeder::class);
//        $this->call(PhilippineProvincesTableSeeder::class);
//        $this->call(PhilippineCitiesTableSeeder::class);
//        $this->call(PhilippineBarangaysTableSeeder::class);

        $this->call(SimulationSeeder::class);

        Model::reguard();
    }
}
