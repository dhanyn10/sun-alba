<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAll()
    {
        $data = User::all()->makeHidden(['password']);
        return response()->json($data);
    }

    public function login(Request $request)
    {
        $ms = null;
        $scode = 0;

        $name       = $request->name;
        $password   = $request->password;

        $checkUser = User::where('name', $name)->get();
        if(count($checkUser) > 0)
        {
            $checkPassword = $checkUser->password;
            if(Hash::check($password, $checkPassword))
            {
                $ms = "logged in";
                $scode = 200;
            }
            else
            {
                $ms = "password not match";
                $scode = 405;
            }
        }
        else
        {
            $ms = "user not found";
            $scode = 404;
        }
        return response()->json([
            'message'   => $ms
        ], $scode);
    }
}
