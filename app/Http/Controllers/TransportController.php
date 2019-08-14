<?php

namespace App\Http\Controllers;


use App\Services\Transport\TransportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TransportController extends Controller
{
    //
    protected $transportService;

    public function __construct(TransportService $transportService)
    {
        $this->transportService = $transportService;
    }

    public function redirectToRegisterRoute() {
        return view('transport.registerroute');
    }

    public function storeRoute(Request $request) {
        Log::info("Will create a new route here");

        $this->transportService->createRoute($request);

        return back()->with('status', __('Saved'));
    }
}
