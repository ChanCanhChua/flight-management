<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\User;
use Illuminate\View\View;
use Igaster\LaravelCities\Geo;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    public function index(): View
    {   
        return view('admin.pages.dashboard', [ 'pageName' => 'Trang Chu']  );
    }
}
