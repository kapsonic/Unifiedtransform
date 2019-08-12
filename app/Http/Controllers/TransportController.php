<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TransportController extends Controller
{
    //

    public function redirectToRegisterRoute() {
        return view('transport.registerroute');
    }

    public function storeRoute(Request $request) {
        Log::info("Will create a new route here");
        Log::info($request->name);
        Log::info($request->stops);

        return back()->with('status', __('Saved'));
    }
}
