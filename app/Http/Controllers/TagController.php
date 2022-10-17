<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function showAll()
    {
        $data = Tag::all()->makeHidden(['created_at', 'updated_at']);
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

        $check = Tag::where('name', $name)->get();
        if(count($check) == 0)
        {
            $create = Tag::create([
                'name'  => $name
            ]);
            if($create)
            {
                $ms = "tag created";
                $scode = 200;
            }
            else
            {
                $ms = "failed creating tag";
                $scode = 405;
            }
        }
        else
        {
            $ms = "tag name already exists";
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

        if($name === null)
        {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

        $check = Tag::where('id', $id)->get();
        if(count($check) > 0)
        {
            $update = Tag::where('id', $id)->update([
                'name'  => $name
            ]);
            if($update)
            {
                $ms = "tag updated";
                $scode = 200;
            }
            else
            {
                $ms = "failed updating tag";
                $scode = 405;
            }
        }
        else
        {
            $ms = "cannot find tag";
            $scode = 404;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }

    public function delete(Request $request)
    {
        $id     = $request->id;

        $ms = null;
        $scode = 0;

        $check = Tag::where('id', $id)->get();
        if(count($check) > 0)
        {
            $update = Tag::where('id', $id)->delete();
            if($update)
            {
                $ms = "tag deleted";
                $scode = 200;
            }
            else
            {
                $ms = "failed deleting tag";
                $scode = 405;
            }
        }
        else
        {
            $ms = "cannot find tag";
            $scode = 404;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }
}
