<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index () 
    {
        $users = User::all();
        // $result = ['users' => $users->map(function ($user) {
        //     return [
        //         'email' => $user->email,
        //         'id' => $user->id
        //     ];
        // })];
        // return response($result);
        // return response()->json($users);
        $numberOfNewUsers = 20;
        return UserResource::collection($users)->additional(['number_of_new_users' => $numberOfNewUsers]);
        //php artisan make:resource NameResource
        // return view();
    }

    public function showUser (User $user) 
    {
        $numberOfNewUsers = 30;
        // return response($user);
        return UserResource::make($user)->additional(['number_of_new_users' => $numberOfNewUsers]);
    }
}
