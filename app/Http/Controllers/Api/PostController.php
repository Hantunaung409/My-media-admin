<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post api
    public function allPost(){
        $post = Post::get();
        return response()->json([
            'post' => $post
        ]);
    }

    //post search
    public function postSearch(Request $request){
        $searchResult = Post::orWhere('title','like','%'.$request->searchKey.'%')
                              ->orWhere('description','like','%'.$request->searchKey.'%')
                              ->get();

        return response()->json([
            'searchResult' => $searchResult
        ]);
        }
}
