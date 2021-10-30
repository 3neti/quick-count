<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\{Contact, Poll, PollItem};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function poll_has_contact()
    {
        /*** arrange ***/
        $contact = Contact::factory()->create();

        /*** act ***/
        $poll = Poll::make();
        $poll->contact()->associate($contact);
        $poll->save();

        /*** assert ***/
        $this->assertDatabaseHas('polls', ['contact_id' => $contact->id]);
    }

    /** @test */
    public function poll_has_many_poll_items()
    {
        /*** arrange ***/
        $poll = Poll::factory()->create();
        $poll_item1 = PollItem::factory()->create(['poll_id' => $poll->id]);
        $poll_item2 = PollItem::factory()->create(['poll_id' => $poll->id]);

        /*** act ***/
        $poll->pollItems()->saveMany([$poll_item1, $poll_item2]);

        /*** assert ***/
        $this->assertDatabaseHas('poll_items', [
            'poll_id' => $poll->id,
            'candidate_id' => $poll_item1->candidate->id,
            'votes' => $poll_item1->votes
        ]);
        $this->assertDatabaseHas('poll_items', [
            'poll_id' => $poll->id,
            'candidate_id' => $poll_item2->candidate->id,
            'votes' => $poll_item2->votes
        ]);
    }
}
