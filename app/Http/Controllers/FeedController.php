<?php

namespace App\Http\Controllers;

class FeedController extends Controller
{

    public function feed (string $firstname = 'Arthur', string $lastname = 'Dent')
    {
        return "Hallo $firstname $lastname";
    }

    public function api (string $firstname = 'Arthur', string $lastname = 'Dent')
    {
        return [
          'sentence' => "Hallo $firstname $lastname"
        ];
    }

}
