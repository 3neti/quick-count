<?php

namespace App\Classes;

use App\Models\Candidate;

class CandidateVote
{
    /** @var Candidate */
    public Candidate $candidate;

    /** @var int */
    public int $votes;

    public function __construct(Candidate $candidate, int $votes)
    {
        $this->candidate = $candidate;
        $this->votes = $votes;
    }
}
