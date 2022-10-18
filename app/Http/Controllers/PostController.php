<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function showAll()
    {
        $data = Post::all()->makehidden(['created_at', 'updated_at']);
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $title      = $request->title;
        $content    = $request->content;
        $categories = $request->categories;
        $tags       = $request->tags;

        $ms = null;
        $scode = 0;

        if(
            $title === null ||
            $content === null ||
            $categories === null ||
            $tags === null
        ) {
            return response()->json([
                'message' => "wrong input"
            ], 405);
        }

        $check = Post::where('title', $title)->get();
        if(count($check) == 0)
        {
            $create = Post::create([
                'title'  => $title,
                'content' => $content,
                'categories' => $categories,
                'tags'  => $tags
            ]);
            if($create)
            {
                $ms = "post created";
                $scode = 200;
            }
            else
            {
                $ms = "failed creating post";
                $scode = 405;
            }
        }
        else
        {
            $ms = "post already exists";
            $scode = 405;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }
}
