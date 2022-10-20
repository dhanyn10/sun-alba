<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showAll()
    {
        $data = json_decode(Redis::get('users'));
        if($data == null)
        {
            $data = User::all()->makeHidden(['password']);
            Redis::set('users', json_encode($data));
        }
        return response()->json($data);
    }

    public function register(Request $request)
    {
        $name   = $request->name;
        $email  = $request->email;
        $password = $request->password;

        $ms = null;
        $scode = 0;

        if(
            $name === null ||
            $email === null ||
            $password === null
        )
        {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

        $checkUser = User::where('email', $email)->get();
        if(count($checkUser) > 0)
        {
            $ms = "user already exist";
            $scode = 405;
        }
        else
        {
            $create = User::create([
                'name'  => $name,
                'email' => $email,
                'password'  => Hash::make($password)
            ]);
            if($create)
            {
                $ms = "data created";
                $scode = 200;
            }
            else
            {
                $ms = "failed creating data";
                $scode = 405;
            }
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }

    public function login(Request $request)
    {
        $ms = null;
        $scode = 0;

        $email      = $request->email;
        $password   = $request->password;

        if(
            $email === null ||
            $password === null
        )
        {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

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

        if(
            $email === null ||
            $password === null
        )
        {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

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
