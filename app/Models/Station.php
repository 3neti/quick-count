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
}
