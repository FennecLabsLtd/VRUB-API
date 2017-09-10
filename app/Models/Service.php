<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public static $authenticatedService = null;

    protected $visible = ['id', 'title'];

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function generateKeys($regenerate = false)
    {
        if ($this->public == null || $regenerate) {
            do {
                $this->public = str_random(32);
            } while (Service::where('public', $this->public)->count() > 0);
        }

        if ($this->secret == null || $regenerate) {
            do {
                $this->secret = str_random(64); // Why not.
            } while (Service::where('secret', $this->secret)->count() > 0);
        }

        $this->save();
    }

    public function checkShareableTicket($ticket)
    {
        $ticket = $this->tickets()->where('shareable_ticket', $ticket)->first();

        if (!$ticket) {
            abort(404, "Could not locate signed ticket, or that ticket is not valid for this third party service.");
        }

        return $ticket->getData();
    }
}
