<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function pollItems()
    {
        return $this->hasMany(PollItem::class);
    }
}
