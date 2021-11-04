<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'cluster',
        'place',
        'barangay',
        'municity',
        'district',
        'province',
        'region',
        'island'
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangay_code', 'barangay_code');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_municipality_code', 'city_municipality_code');
    }
}
