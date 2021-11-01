<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Candidate, PollItem};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PollItemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function poll_item_has_votes_and_belongs_to_a_candidate()
    {
        /*** arrange ***/
        $candidate = Candidate::factory()->create();
        $votes = $this->faker->numberBetween(1,1000);

        /*** act ***/
        $poll_item = PollItem::make(compact('votes'));
        $poll_item->candidate()->associate($candidate);
        $poll_item->save();

        /*** assert ***/
        $this->assertDatabaseHas('poll_items', [
            'candidate_id' => $candidate->id,
            'votes' => $votes
        ]);
    }
}
