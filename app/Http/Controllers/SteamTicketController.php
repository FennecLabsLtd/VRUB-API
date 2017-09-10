<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SteamTicketController extends Controller
{
    public function info(Request $request)
    {
        return Service::$authenticatedService;
    }

    public function request(Request $request)
    {
        $this->validate([
            'ticket' => 'required|string',
        ]);

        $steamTicket = $request->get('ticket');

        $ticket = new Ticket;
        $ticket->steam_ticket = $steamTicket;
        $ticket->service_id = Service::$authenticatedService->id;
        $ticket->generateSharableTicket();
        $ticket->save();

        return $ticket;
    }

    public function check(Request $request)
    {
        $this->validate([
            'ticket' => 'required|string',
        ]);

        $shareableTicket = $request->get('ticket');

        return Service::checkShareableTicket($shareableTicket);
    }
}
