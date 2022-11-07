<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function allCategory(){
        $data = Category::select('category_id','title','description')->get();
        return response()->json([
            'category' => $data
        ]);
    }

}
