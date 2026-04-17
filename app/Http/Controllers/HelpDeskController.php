<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Location;


class HelpDeskController extends Controller
{
    public function insert()
    {
        $asset = Asset::select('id','asset_name')->get();
        $location = Location::select('id','name')->get();
        return view('pages.help-desk.add',compact('asset','location'));
    }

    public function index()
    {
        return view('pages.help-desk.list');
    }
}
