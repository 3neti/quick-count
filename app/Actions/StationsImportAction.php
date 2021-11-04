<?php

namespace App\Actions;

use App\Imports\StationsImport;
use Lorisleiva\Actions\Concerns\AsAction;

class StationsImportAction
{
    use AsAction;

    public function handle($path = 'stations.xlsx')
    {
        (new StationsImport)->import($path);
    }

    public function asController()
    {
        $this->handle();

        return redirect('/')->with('success', 'All good!');
    }
}
