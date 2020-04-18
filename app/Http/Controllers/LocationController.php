<?php

namespace App\Http\Controllers;
use Exception;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $locations = Location::all();

            return response()->json([
                'locations' => $locations,
                'msg' => 'success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validateData = $request->validate([
                'postal_code' => 'required|numeric|min:1000|max:9999',
                'street' => 'required|string',
                'number' => 'required|numeric|min:0|max:100000',
                'apartment' => 'nullable|string',
                'locality' => 'required|string',
                'province' => 'required|string',
                'province_department' => 'required|string',
                'indicator' => 'string|min:0|nullable'
            ]);
            $address = new Location();
            $address->postal_code =  $request->postal_code;
            $address->street = $request->street;
            $address->number = $request->number;
            $address->apartment = $request->apartment;
            $address->locality = $request->locality;
            $address->province = $request->province;
            $address->indications = $request->indicator;
            $address->province_department = $request->province_department;
            $address->user_id = Auth::user()->id;
            $address->save();
            
            return response()->json([
                "msg" => "created",
            ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $address = $location;
        $validateData = $request->validate([
            'postal_code' => 'required|numeric|min:1000|max:9999',
            'street' => 'required|string',
            'number' => 'required|numeric|min:0|max:100000',
            'apartment' => 'nullable|string',
            'locality' => 'required|string',
            'province' => 'required|string',
            'province_department' => 'required|string',
            'indicator' => 'string|min:0|nullable'
        ]);
        $address->postal_code =  $request->postal_code;
        $address->street = $request->street;
        $address->number = $request->number;
        $address->apartment = $request->apartment;
        $address->locality = $request->locality;
        $address->indications = $request->indicator;
        $address->province = $request->province;
        $address->province_department = $request->province_department;
        $address->user_id = Auth::user()->id;
        $address->save();

        return response()->json([
            "msg" => "created",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        try {
            $location->delete();
            return response()->json([
                'msg' => 'La dirección fue eliminada',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Ha ocurrido un error',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
