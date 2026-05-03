<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $assetCount = Asset::count();
        $ticketCount = Ticket::count();

        return view('dashboard', compact('assetCount','ticketCount'));
    }
}
