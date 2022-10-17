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
}
