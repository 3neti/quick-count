<?php

namespace Tests\Unit;

use App\Models\Station;
use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contact_has_mobile_and_handle()
    {
        /*** arrange ***/
        $mobile = '09173011987';
        $handle = 'Lester Hurtado';

        /*** act ***/
        Contact::create(compact('mobile', 'handle'));

        /*** assert ***/
        $this->assertDatabaseHas('contacts', compact('mobile', 'handle'));
    }

    /** @test */
    public function contact_belongs_to_a_station()
    {
        /*** arrange ***/
        $contact = Contact::factory()->create();
        $station = Station::factory()->create();

        /*** act ***/
        $contact->station()->associate($station);
        $contact->save();

        /*** assert ***/
        $this->assertDatabaseHas('contacts', ['station_id' => $station->id]);
    }
}
