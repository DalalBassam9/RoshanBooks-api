<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Resources\Admin\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return UserResource::collection($users);
    }

}
