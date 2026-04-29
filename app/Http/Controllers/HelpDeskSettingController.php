<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpDeskSettingController extends Controller
{
    public function index_type()
    {
        return view('pages.help-desk-settings.ticket-type.index');
    }

    // public function index_status()
    // {
    //     return view('pages.help-desk-settings.ticket-status.index');
    // }
}
