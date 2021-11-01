<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Station;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function station_has_cluster()
    {
        /*** arrange ***/
        $cluster = '123456';

        /*** act ***/
        Station::create(compact('cluster'));

        /*** assert ***/
        $this->assertDatabaseHas('stations', compact('cluster'));
    }
}
