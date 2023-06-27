<?php

namespace App\Http\Controllers;

use domain\Facades\BannerFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/index');
    }
}
