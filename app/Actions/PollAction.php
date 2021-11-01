<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use App\Models\{Poll, Candidate, Contact, PollItem};
use Lorisleiva\Actions\Concerns\AsAction;

class PollAction
{
    use AsAction;

    public function handle(Contact $contact, Collection $collection)
    {
        $poll = Poll::make();
        $poll->contact()->associate($contact);
        $poll->station()->associate($contact->station);
        $poll->save();

        $collection->each(function($cv, $key) use ($poll) {
            $poll_item = PollItem::make();
            $poll_item->poll()->associate($poll);
            $poll_item->candidate()->associate($cv->candidate);
            $poll_item->votes = $cv->votes;
            $poll_item->save();

            return true;
        });

    }
}
