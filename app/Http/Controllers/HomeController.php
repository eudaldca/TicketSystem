<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $test = Ticket::find(1)->issuer;
        dd($test);
        return view('home');
    }
}
