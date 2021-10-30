<?php

namespace Tests\Unit;

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
}
