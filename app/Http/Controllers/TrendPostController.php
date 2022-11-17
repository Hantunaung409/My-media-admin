<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct index page
    public function index(){
      $data = Action::select('actions.*', 'posts.*',DB::raw('COUNT(posts.post_id) as post_count'))
                      ->leftJoin('posts','actions.post_id','posts.post_id')
                      ->groupBy('actions.post_id')
                      ->get();
     
        return view('admin.trend_post.index',compact('data'));
    }

    //direct trend post details
    public function trendPostDetails($id){
        $data = Post::where('post_id',$id)->first();
        return view('admin.trend_post.details',compact('data'));
    }
}
