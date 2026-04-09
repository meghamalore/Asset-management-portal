<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpDeskController extends Controller
{
    public function insert()
    {
        return view('pages.help-desk.add');
    }

    public function index()
    {
        return view('pages.help-desk.list');
    }
}
