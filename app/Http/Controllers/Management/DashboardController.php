<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Greeting;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('management.dashboard');
    }
}
