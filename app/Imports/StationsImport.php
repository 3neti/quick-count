<?php

namespace App\Imports;

use App\Models\Station;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StationsImport implements ToModel, WithUpserts, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Station|null
     */
    public function model(array $row): ?Station
    {
        return new Station([
            'cluster'       => $row['cluster'],
            'place'         => $row['place'],
            'barangay'      => $row['barangay'],
            'municity'      => $row['municity'],
            'district'      => $row['district'],
            'province'      => $row['province'],
            'region'        => $row['region'],
            'island'        => $row['island'],
        ]);
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return ['municity', 'cluster'];
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
