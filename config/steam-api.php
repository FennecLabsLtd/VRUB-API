<?php

return array(

    /**
     * You can get a steam API key from http://steamcommunity.com/dev/apikey
     * Once you get your key, add it here.
     */
    'steamApiKey' => env('STEAM_WEB_API_KEY', false),
    'steamPublisherKey' => env('STEAM_PUBLISHER_API_KEY', false),
    'steamAppId' => env('STEAM_APP_ID', 0),
);
