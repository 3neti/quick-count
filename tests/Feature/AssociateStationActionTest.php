<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Actions\AssociateStationAction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\{Contact, Candidate, Poll, PollItem, Station};

class AssociateStationActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function associate_station_action_works()
    {
        /*** arrange ***/
        $contact = Contact::factory()->create(['station_id' => null]);
        $station = Station::factory()->create();

        /*** act ***/
        AssociateStationAction::run($station, $contact);

        /*** assert ***/
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'station_id' => $station->id
        ]);
    }
}
