<?php

namespace App\Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $visible = ['service', 'id', 'sharable_ticket'];

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function getData()
    {
        $client = new Client();

        try {
            $result = $client->get('https://api.steampowered.com/ISteamUserAuth/AuthenticateUserTicket/v1/', [
                'query' => [
                    'key' => config('steam-api.steamPublisherApiKey'),
                    'appid' => config('steam-api.steamAppId'),
                    'ticket' => $this->steam_ticket,
                ],
            ]);

            return json_decode($result->getBody());
        } catch (RequestException $e) {
            // TODO: Handle request exceptions.
        }

    }

    public function generateShareableTicket()
    {
        do {
            $this->shareable_ticket = str_random(128);
        } while (SignedTicket::where('sharable_ticket', $this->shareable_ticket)->where('service_id', $this->service_id)->count() > 0);
    }
}
