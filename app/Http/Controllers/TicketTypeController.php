<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketStatus;
use App\Models\Category;
use App\Models\Location;


class TicketTypeController extends Controller
{
    public function add()
    {
        $category = Category::all();
        $location = Location::all();
        return view('pages.help-desk-settings.ticket-type.add',compact('category','location'));
    }
}
