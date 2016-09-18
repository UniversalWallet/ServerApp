<?php

namespace App\Http\Controllers\Front;

use App\Ticket;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\GuzzleClient;
use LetsAgree\GethJsonRpcPhpClient\JsonRpc\GuzzleClientFactory;

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

    public function storeTicketPerform(Request $request)
    {
        $data = $request->input();

        $ticket = new Ticket();

        $partners = [
            '3' => [
                'type' => 'avia',
                'partner_id' => 3,
                'partner_name' => 'Аэрофлот',
                'scope' => 'full',
                'verified' => 0,
            ],
            '2' => [
                'type' => 'concert',
                'partner_id' => 2,
                'partner_name' => 'Лужники',
                'scope' => 'full_name',
                'verified' => 1,
            ],
            '1' => [
                'type' => 'rail',
                'partner_id' => 1,
                'partner_name' => 'РЖД',
                'scope' => 'passport',
                'verified' => 0,
            ],
            '4' => [
                'type' => 'cinema',
                'partner_id' => 4,
                'partner_name' => 'КАРО Фильм',
                'scope' => 'full_name',
                'verified' => 1,
            ]
        ];
        $ticket->fill(array_merge($data,$partners[$data['partner_id']]));
        $ticket->save();

        $command = escapeshellcmd('save.py --id= '.$ticket->id.' --price='.$ticket->price.' --name='.$ticket->name);
        $output = shell_exec($command);

        return $this->success('Билет успешно добавлен');
    }

    public function listOfTickets(Request $request)
    {
        $tickets = $request->has('address') ? Ticket::where('address','=', $request->input('address'))->where('verified',1)->get() : Ticket::all();
        $address = $request->input('address');

        $responseArray = [];

        foreach ($tickets as $ticket) {
            /**
             * @var $ticket Ticket
             */
            $responseArray[] = [
                'type' => $ticket->type,
                'time' => $ticket->time_at,
                'event' => $ticket->name,
                'place' => $ticket->place,
                'seat' => $ticket->seat,
                'price' => $ticket->price,
                'ticket_id' => $ticket->vendor_id,
                'partner_id' => $ticket->partner_id,
                'partner_name' => $ticket->partner_name,
                'image' => public_path('images/aeroflot.png'),
                'hash' => '0x'.str_random(30)
            ];
        }
        return response()->json([
            'data' => $responseArray, 'meta' => [

            ]
        ]);
    }

    public function toVerify(Request $request) {
        $address = $request->input('address');

        $tickets = $request->has('address') ? Ticket::where('address','=', $request->input('address'))->where('verified',0)->get() : Ticket::where('verified',0)->get();

        $responseArray = [];

        foreach ($tickets as $ticket) {
            /**
             * @var $ticket Ticket
             */
            $responseArray[] = [
                'requrest_id' => $ticket->id,
                'scope' => $ticket->scope,
                'partner_id' => $ticket->partner_id,
                'partner_name' => $ticket->partner_name,
            ];
        }

        return response()->json([
            'data' => $responseArray, 'meta' => [

            ]
        ]);
    }

    public function verify(Request $request) {

        $tickets = Ticket::where('verified','=',0)->get();


        foreach ($tickets as $ticket)
        {
            $ticket->verified = 1;
            $ticket->save();

            $command = escapeshellcmd('verify.py --id='.$ticket->id);
            $output = shell_exec($command);
        }

        return response()->json([
            'data' => [
                'verified' => 1,
            ], 'meta' => [
                ''
            ]
        ]);
    }
}
