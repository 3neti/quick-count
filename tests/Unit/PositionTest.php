<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contact_has_mobile_and_handle()
    {
        /*** arrange ***/
        $title = 'President';
        $jurisdiction = 'Philippines';

        /*** act ***/
        Position::create(compact('title', 'jurisdiction'));

        /*** assert ***/
        $this->assertDatabaseHas('positions', compact('title', 'jurisdiction'));
    }
}
