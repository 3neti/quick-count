<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LBHurtado\Missive\Models\Airtime;

class AirtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airtime::create([ 'key' => 'incoming-sms',  'credits' =>    0.005   ]);
        Airtime::create([ 'key' => 'outgoing-sms',  'credits' =>    0.02    ]);
        Airtime::create([ 'key' => 'lbs',           'credits' =>    0.05    ]);
        Airtime::create([ 'key' => 'load-10',       'credits' =>    0.27    ]);
        Airtime::create([ 'key' => 'load-25',       'credits' =>    0.61    ]);
    }
}
