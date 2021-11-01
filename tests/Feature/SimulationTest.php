<?php

namespace Tests\Feature;

use App\Models\PollItem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SimulationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function simulation_works()
    {
        $this->artisan('db:seed');

        $result = PollItem::all()->groupBy(function ($data) {
            return $data->candidate_id;
        })->sum('votes');

        dd($result);
    }
}
