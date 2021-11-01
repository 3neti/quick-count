<?php

namespace App\Actions;

use App\Models\{Contact, Station};
use Lorisleiva\Actions\Concerns\AsAction;

class AssociateStationAction
{
    use AsAction;

    public function handle(Station $station, Contact $contact)
    {
        $contact->station()->associate($station);
        $contact->save();
    }
}
