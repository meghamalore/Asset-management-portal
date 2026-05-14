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

    public function index()
    {

        $locations = Location::with('subLocation')->get();
        return view('pages.administration.location.index',compact('locations'));

    }

    public function edit($id)
    {
        $location = Location::with('subLocation')->findOrFail($id);
        // dd($category);
        return view('pages.administration.location.edit', compact('location'));
    }

     public function view($id)
    {
        $location = Location::with('subLocation')->findOrFail($id);
        // dd($category);
        return view('pages.administration.location.view', compact('location'));
    }

    public function update(Request $request, $id)
    {
       $location = Location::with('subLocation')->findOrFail($id);

        // // Validation
        // $request->validate([
        //     'parent_category_name' => 'required|string|max:255',
        //     'sub_category_name'    => 'nullable|string|max:255',
        //     'category_code'        => 'nullable|string|max:255',
        //     'trafs_duration'       => 'nullable|numeric',
        //     'trafs_duration_type'  => 'nullable|string',
        //     'is_link_asset'        => 'nullable|boolean',
        //     'cascade'              => 'nullable|boolean',
        //     'allow_auto'           => 'nullable|boolean',
        // ]);

        // Update Category
        $location->update([
            'name'          => $request->parent_location_name,
            'location_code' => $request->location_code,
            'description'   => $request->description,
        ]);

        // Update or Create Sub Category
       if ($request->has('sub_locations')) {

            // Delete old sub locations
            $location->subLocation()->delete();

            // Insert new sub locations
            foreach ($request->sub_locations as $subLocationName) {

                SubLocation::create([
                    'location_id' => $location->id,
                    'name'        => $subLocationName
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Location Updated Successfully'
        ]);
    }

    public function destroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return redirect()->back()->with('error', 'Record not found');
        }

        $location->delete();

        return response()->json([
                'status' => true,
                'message' => 'Location deleted successfully'
            ]);
    }
}
