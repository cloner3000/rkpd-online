<?php

namespace App\Http\Controllers;

use App\Tahapan;
use App\Services\DashboardService;

class HomeController extends Controller
{
    protected $dashboard_service;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DashboardService $dashboard_service)
    {
        $this->middleware('auth');
        $this->dashboard_service = $dashboard_service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->dashboard_service->index();
        return view('home.index', compact('items'));
    }
}
