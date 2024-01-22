<?php

namespace App\Http\Controllers;

use App\Http\Resources\Website\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser()
    {
        return UserResource::make(
            auth()->user()
        );
    }
}
