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
        try {

            // VALIDATION (same like category)
            if (!$request->parent_location_name && !$request->selective_location_id) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please enter location name or select one'
                ], 422);
            }

            // 1. LOCATION (create OR use existing)
            if ($request->parent_location_name) {

                $location = Location::create([
                    'name' => $request->parent_location_name,
                    'location_code' => $request->location_code,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'description' => $request->description,
                    'is_inventory' => $request->is_inventory ? 1 : 0,
                ]);

                $location_id = $location->id;

            } else {
                // use selected location
                $location_id = $request->selective_location_id;
            }

            //  2. SUB LOCATION (only once)
            if ($request->parent_location_name || $request->selective_location_id) {
                SubLocation::create([
                    'location_id' => $location_id,
                    'name' => $request->local_location_name
                ]);
            }

            // 3. ADDITIONAL INFORMATION (MULTIPLE)
            if ($request->department) {
                foreach ($request->department as $key => $dept) {

                    LocationAdditionalInformation::create([
                        'location_id' => $location_id,
                        'department' => $dept,
                        'users' => $request->users[$key] ?? null,
                    ]);
                }
            }

            // 4. LOCALIZATION (MULTIPLE)
            if ($request->language) {
                foreach ($request->language as $key => $lang) {

                    LocationNameLocalization::create([
                        'location_id' => $location_id,
                        'location_name' => $request->location_name[$key] ?? null,
                        'language' => $lang
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Location Created Successfully'
            ]);

        } catch (\Exception $e) {

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
