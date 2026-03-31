<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\LocationAdditionalInformation;
use App\Models\LocationNameLocalization;
use App\Models\SubLocation;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        // DB::beginTransaction();

        try {
            // 1. LOCATION
            $location = Location::create([
                'name' => $request->local_location_name,
                'location_code' => $request->location_code,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'description' => $request->description,
                'is_inventory' => $request->is_inventory ? 1 : 0,
            ]);

            // 2. SUB LOCATION (Parent)
            if ($request->parent_location_name) {
                SubLocation::create([
                    'location_id' => $location->id,
                    'name' => $request->parent_location_name
                ]);
            }

            // 3. ADDITIONAL INFORMATION (MULTIPLE)
            if ($request->department) {
                foreach ($request->department as $key => $dept) {

                    LocationAdditionalInformation::create([
                        'location_id' => $location->id,
                        'department' => $dept,
                        'users' => $request->users[$key] ?? null,
                    ]);
                }
            }

            // 4. LOCALIZATION (MULTIPLE)
            if ($request->language) {
                foreach ($request->language as $key => $lang) {

                    LocationNameLocalization::create([
                        'location_id' => $location->id,
                        'location_name' => $request->location_name[$key] ?? null,
                        'language' => $lang
                    ]);
                }
            }

            // DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Location Created Successfully'
            ]);

        } catch (\Exception $e) {
            // DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getSubLocation($id)
    {
        $subLocations = SubLocation::where('location_id', $id)->get();

        return response()->json($subLocations);
    }
}
