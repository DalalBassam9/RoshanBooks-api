<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::orderBy('created_at', 'desc')->paginate(10);
        return  CityResource::collection($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {

        $city = City::create($request->all());

        return new CityResource($city);
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, $cityId)
    {
        $city = City::findOrFail($cityId);
        $city->update(['name' => $request->name]);
        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cityId)
    {
        $city = City::findOrFail($cityId);
        $city->delete();
        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource.
     */
    public function getCitiesLookups()
    {
        $cities = City::select('cityId', 'name')->get();
        return response()->json(['cities' => $cities]);
    }
}
