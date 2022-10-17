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
}
