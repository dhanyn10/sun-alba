<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function showAll()
    {
        $data = Category::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $name = $request->name;
        $ms = null;
        $scode = 0;

        if($name === null)
        {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

        $check = Category::where('name', $name)->get();
        if(count($check) == 0)
        {
            $create = Category::create([
                'name'  => $name
            ]);
            if($create)
            {
                $ms = "category created";
                $scode = 200;
            }
            else
            {
                $ms = "failed creating category";
                $scode = 405;
            }
        }
        else
        {
            $ms = "category name already exists";
            $scode = 405;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }

    public function update(Request $request)
    {
        $id     = $request->id;
        $name   = $request->name;

        $ms = null;
        $scode = 0;

        if($name === null || $id === null)
        {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

        $check = Category::where('id', $id)->get();
        if(count($check) > 0)
        {
            $update = Category::where('id', $id)->update([
                'name'  => $name
            ]);
            if($update)
            {
                $ms = "category updated";
                $scode = 200;
            }
            else
            {
                $ms = "failed updating category";
                $scode = 405;
            }
        }
        else
        {
            $ms = "cannot find category";
            $scode = 404;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }
}
