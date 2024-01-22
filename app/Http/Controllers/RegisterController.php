<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required',
            'image'
        ]);

        $user = User::create([
            'firstName' => request('firstName'),
            'lastName' => request('lastName'),
            'phone' => request('phone'),
            'email' => request('email'),
            'image'=>null,
            'password' => Hash::make(request('password')),
        ]);

        Auth::guard('web')->login($user);
    }
}
