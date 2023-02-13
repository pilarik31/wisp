<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new JsonResponse([
            1 => [
                'id' => 1,
                'lat' => 49.88915,
                'lng' => 15.47213,
                'tooltip' => 'Home',
                'ptp' => 2
            ],
            2 => [
                'id' => 2,
                'lat' => 49.88937,
                'lng' => 15.47129,
                'tooltip' => 'Grands',
                'ptp' => null
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $pin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        //
    }
}
