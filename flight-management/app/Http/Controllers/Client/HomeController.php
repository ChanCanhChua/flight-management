<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\City;
use App\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $airports = Airport::with('city')->get();

        return view('client.pages.home',
        [
            'origin_aps' => $airports,
            'destination_aps' => $airports,
        ]);
    }

}

