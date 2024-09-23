<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    // This will show dashboard for user
    public function index()
    {
        return view("dashboard");
    }
}
