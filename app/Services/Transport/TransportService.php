<?php
namespace App\Services\User;

use App\Route;
use App\User;
use App\StudentInfo;
use Illuminate\Support\Facades\DB;
use Mavinoo\LaravelBatch\Batch;
use Illuminate\Support\Facades\Log;

class TransportService {

    public function createRoute($request) {
        $r = new Route();
        $r->name = $request->name;
        $r->source = $request->source;
        $r->destination= $request->destination;
        $r->startTime = $request->startTime;
        $r->endTime = $request->endTime;
        $r->stops = $request->stops;

        $r->school_id = auth()->user()->school_id;

        $r->save();

    }
}
