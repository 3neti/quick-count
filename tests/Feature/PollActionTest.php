<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Actions\PollAction;
use App\Classes\CandidateVote;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Contact, Candidate, Poll, PollItem};

class PollActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function poll_action_works()
    {
        /*** arrange ***/
        $contact = Contact::factory()->create();
        $candidates = Candidate::factory(5)->create();
        $cv = [];
        $candidates->each(function ($candidate, $key) use (&$cv) {
            $vote = $this->faker->numberBetween(0, 100);
            $cv [] = new CandidateVote($candidate, $vote);

            return true;
        });
        $collection = collect($cv);

        /*** act ***/
        PollAction::run($contact, $collection);

        /*** assert ***/
        $this->assertDatabaseHas('polls', [
            'contact_id' => $contact->id,
            'station_id' => $contact->station->id
        ]);
        $collection->each(function($cv, $key) {
            $this->assertDatabaseHas('poll_items', [
                'candidate_id' => $cv->candidate->id,
                'votes' => $cv->votes
            ]);
        });
    }
}
