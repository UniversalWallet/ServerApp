<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index()
    {
        return view('welcome');
    }

    public function storeTicket(Request $request)
    {
        return view('create');
    }

    public function listOfTickets(Request $request)
    {
        $address = $request->input('address');
        return response()->json([
            'data' => [
                'type' => 'avia',
                'time' => '2016-09-29 13:30',
                'event' => 'MSK - PHU',
                'place' => 'Sheremetevo',
                'price' => '13 000 руб.',
                'ticket_id' => 'QWER432',
                'partner_id' => 3,
                'partner_name' => 'Aeroflot'
            ], 'meta' => [
                ''
            ]
        ]);
    }

    public function toVerify(Request $request) {
        $address = $request->input('address');
        return response()->json([
            'data' => [
                'requrest_id' => 1,
                'scope' => 'full',
                'partner_id' => 3,
                'partner_name' => 'Aeroflot'
            ], 'meta' => [
                ''
            ]
        ]);
    }

    public function verify(Request $request) {
        return response()->json([
            'data' => [
                'verified' => 1,
            ], 'meta' => [
                ''
            ]
        ]);
    }
}
