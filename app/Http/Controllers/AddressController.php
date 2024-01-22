<?php

namespace App\Http\Controllers;

use App\Http\Resources\Website\AddressResource;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Get all Addresses.
     * @return JsonResponse
     */
    public function getUserAddressess()
    {
        $addresses = Address::with('city:cityId,name')->where('userId',auth()->user()->userId)->get();
        return new AddressResource($addresses);
    }
    /**
     * Store a new Address record .
     * @param AddressRequest $request
     * @return JsonResponse
     */
    public function store(AddressRequest $request)
    {
        $addressDefault = Address::where('userId', auth()->user()->userId)->where('default', true)->first();

        if ($addressDefault) {
            $addressDefault->update(['default' => false]);
        }


        $address = Address::create([
            'userId' => auth()->user()->userId,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'cityId' =>  $request->cityId,
            'district' => $request->district,
            'phone' => $request->phone,
            'address' => $request->address,
            'default' => true
        ]);

        return new AddressResource($address);
    }

    /**
     * Update Address record .
     *
     * @param AddressRequest $request
     * @param int|string  $addressId
     * @return JsonResponse
     */
    public function update(AddressRequest $request, $id)
    {
        $user = auth()->user()->userId;
        $address = Address::findOrFail($id);


        $address->update([
            'userId' => $user,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'cityId' =>  $request->cityId,
            'district' => $request->district,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);


        return new AddressResource($address);
    }

    public function setDefaultAddress($id)
    {
        $address = Address::findOrFail($id);

        Address::where('userId', auth()->user()->userId)
            ->update(['default' => false]);

        $address->default = true;
        $address->save();

        return response()->json(['message' => 'Default address updated successfully']);

    }

    /**
     * Delete Address record .
     * @param int|string $addressId
     * @return JsonResponse
     */

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json(null, 204);
    }
}
