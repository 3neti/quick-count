<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Candidate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CandidateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function candidate_has_code_and_name()
    {
        /*** arrange ***/
        $code = 'PING';
        $name = 'Ping Lacson';

        /*** act ***/
        Candidate::create(compact('code', 'name'));

        /*** assert ***/
        $this->assertDatabaseHas('candidates', compact('code', 'name'));
    }
}
