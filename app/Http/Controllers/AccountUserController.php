<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\UserProfileImageRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\Website\AccountUserResource;


class AccountUserController extends Controller
{
    /**
     *update User Information .
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function updateUserInformation(AccountRequest $request)
    {

        $userId = auth()->user()->userId;
        $user = User::findOrFail($userId);


        $phone = isset($request->phone) ?  $request->phone : $user->phone;

        $email = isset($request->email) ? $request->email : $user->email;
        $firstName = isset($request->firstName) ? $request->firstName : $user->phone;
        $lastName = isset($request->lastName) ? $request->lastName : $user->email;

        $userInformation = $user->update(
            [
                'phone' => $request->phone,
                'email' => $request->email,
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
            ]
        );

        return response()->json($userInformation, 204);

        //return new AccountUserResource($userInformation);
    }
    /**
     *update User Information .
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function updateUserImage(UserProfileImageRequest $request)
    {
        $userId = auth()->user()->userId;
        $user = User::findOrFail($userId);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store("images", 'public');
        } else {
            $image = $user->image;
        }

        $image =  $user->update([
            'image' =>  $image,
        ]);


        return response()->json($image, 204);
    }
    /**
     *update Update Password .
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $userId = auth()->user()->userId;
        $user = User::findOrFail($userId);
        $user->update(['password' => Hash::make($request['password'])]);

        return response()->json(null, 204);
    }
}
