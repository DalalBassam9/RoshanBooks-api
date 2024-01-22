<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class LoginController extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'email' => ['required', 'string'],
            'password' => ['required'],
        ]);

        /**
         * We are authenticating a request from our frontend.
         */
        if (EnsureFrontendRequestsAreStateful::fromFrontend(request())) {
            $this->authenticateFrontend();
        }
        /**
         * We are authenticating a request from a 3rd party.
         */
        else {
            $user = User::where('email', request()->email)->first();

            if (!$user || !Hash::check(request()->password, $user->password)) {
            }

            if (!empty($user->createToken('auth_token')->plainTextToken)) 
            {
                $token= $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'userId' => $user->userId,
                    'firstNme'=>$user->firstName,
                ]);
            }

        }


    }

    private function authenticateFrontend()
    {
        if (! Auth::guard('web')
            ->attempt(
                request()->only('email', 'password'),
                request()->boolean('remember')
            )) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }
}
