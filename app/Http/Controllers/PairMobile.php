<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PairMobile extends Controller
{
    protected $rules = [
        'mobile' => 'required',
        'station_id' => 'required|numeric',
        'municity' => 'required'
    ];
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
