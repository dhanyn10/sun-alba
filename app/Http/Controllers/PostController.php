<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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

        // string -> array
        $decode = json_decode($categories);

        //unique array, antisipasi value duplikat
        $arrayunique = array_unique($decode);

        for($i = 0; $i < count($arrayunique); $i++)
        {
            $check = Category::where('id', $arrayunique[$i])->exists();
            if(!$check)
            {
                return response()->json([
                    'message' => "categories not exists"
                ], 405);
            }
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

    public function update(Request $request)
    {
        $id         = $request->id;
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

        // string -> array
        $decode = json_decode($categories);

        //unique array, antisipasi value duplikat
        $arrayunique = array_unique($decode);

        for($i = 0; $i < count($arrayunique); $i++)
        {
            $check = Category::where('id', $arrayunique[$i])->exists();
            if(!$check)
            {
                return response()->json([
                    'message' => "categories not exists"
                ], 405);
            }
        }

        $check = Post::where('id', $id)->get();
        if(count($check) > 0)
        {
            $update = Post::where('id', $id)->update([
                'title'  => $title,
                'content' => $content,
                'categories' => $categories,
                'tags'  => $tags
            ]);
            if($update)
            {
                $ms = "post updated";
                $scode = 200;
            }
            else
            {
                $ms = "failed updating post";
                $scode = 405;
            }
        }
        else
        {
            $ms = "post not exists";
            $scode = 405;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $ms = null;
        $scode = 0;

        $check = Post::where('id', $id)->get();
        if(count($check) > 0)
        {
            $delete = Post::where('id', $id)->delete();
            if($delete)
            {
                $ms = "post deleted";
                $scode = 200;
            }
            else
            {
                $ms = "failed deleting post";
                $scode = 405;
            }
        }
        else
        {
            $ms = "post not exists";
            $scode = 405;
        }

        return response()->json([
            'message' => $ms
        ], $scode);
    }

    public function blogViews()
    {
        $post = Post::all();
        return view('home', ['post' => $post]);
    }

    public function blogPosts(Request $request)
    {
        $id = $request->id;
        $postitem = Post::where('id', $id)->get();

        // category
        $categories = $postitem->pluck('categories')->first();
        // string -> array
        $categories = json_decode($categories);
        $categoriesData = [];
        for($i = 0; $i < count($categories); $i++)
        {
            $getCategory = Category::where('id', $categories[$i])->get();
            $cname = $getCategory->pluck('name')->first();
            array_push($categoriesData, $cname);
        }
        return view('post', [
            'postitem'  => $postitem,
            'categories' => $categoriesData
        ]);
    }
}
