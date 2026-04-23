<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    public function add()
    {
        return view('pages.help-desk-settings.ticket-status.add');
    }
}
