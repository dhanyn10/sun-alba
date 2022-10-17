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

        $email      = $request->email;
        $password   = $request->password;

        $checkUser = User::where('email', $email)->get();
        if(count($checkUser) > 0)
        {
            $checkPassword = $checkUser->pluck('password')->first();
            if(Hash::check($password, $checkPassword))
            {
                if($request->session()->has('email'))
                {
                    $ms = "already logged in";
                    $scode = 200;
                }
                else
                {
                    $request->session()->put('email', $email);
                    $ms = "logged in";
                    $scode = 200;
                }
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

    public function logout(Request $request)
    {
        $ms = null;
        $scode = 0;

        $email      = $request->email;
        $password   = $request->password;

        $checkUser = User::where('email', $email)->get();
        if(count($checkUser) > 0)
        {
            $checkPassword = $checkUser->pluck('password')->first();
            if(Hash::check($password, $checkPassword))
            {
                if($request->session()->has('email'))
                {
                    $request->session()->flush();
                    $ms = "logged out";
                }
                else
                {
                    $ms = "already logged out";
                }
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
