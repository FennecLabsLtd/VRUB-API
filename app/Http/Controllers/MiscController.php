<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscController extends Controller
{
    public function root(Request $request)
    {
        return "Welcome to the VRUB API root. There isn't much to see here.";
    }
}
