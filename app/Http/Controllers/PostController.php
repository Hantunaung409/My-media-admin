<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct index page
    public function index(){
       $categoryData = Category::get();
       $postData = Post::get();
        return view('admin.post.index',compact('categoryData','postData'));
    }

    //create post
    public function create(Request $request){
        $this->creationValidationCheck($request);
        $fileName = null;
        //for image
        if($request->hasFile('postImage')){
           $file = $request->file('postImage');
           $fileName = uniqid().$file->getClientOriginalName();
           $file->storeAs('public/postImage', $fileName);
        //    $file->Move(public_path().'/postImage',$fileName);
        }
        $data = $this->requestPostData($request,$fileName);
        Post::create($data);
        return redirect()->route('admin@postPage');
    }

    //post delete(using ajax)
    public function delete($id){
        $postImageData = Post::select('image')->where('post_id',$id)->first();
        $postImageName = $postImageData->image;
        // if(File::exists(public_path().'/postImage/'.$postImageName)){
        //     File::delete(public_path().'/postImage/'.$postImageName);
        // }
        if(Storage::exists('public/postImage/'. $postImageName)){
        // Storage::disk('public')->delete('postImage/63612a1a99444Screenshot from 2022-10-31 23-08-47.png');
        // Storage::disk('public')->delete('postImage/'.$postImageName);
           Storage::delete('public/postImage/'. $postImageName);
        }
        Post::where('post_id',$id)->delete();

       return redirect()->route('admin@postPage')->with(['postDeleted' => "A Post Was Deleted Successfully!"]);
    }

    //direct edit page
    public function editPage($postId){
        $categoryData = Category::get();
        $postData = Post::get();
        $targetPostData = Post::where('post_id',$postId)->first();
        return view('admin.post.update',compact('postData','targetPostData','categoryData'));
    }

    //update edited post
    public function edit(Request $request){
        $this->creationValidationCheck($request);
        $data = [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->categoryId,
        ];
        if($request->hasFile('postImage')){
            $oldImageName = Post::where('post_id',$request->postId)->first();
            $oldImageName = $oldImageName->image;
            if($oldImageName != null){
                Storage::delete('public/postImage/'. $oldImageName);
            }
            $file = $request->file('postImage');
            $fileName = uniqid().$file->getClientOriginalName();
            $file->storeAs('public/postImage', $fileName);
            $data['image'] = $fileName;
        }
        Post::where('post_id', $request->postId)->update($data);
        return back();
    }

    //Creation Validation Check
    public function creationValidationCheck($request){
        Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
        ])->validate();
    }

    //requesting creating post data
    public function requestPostData($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->categoryId,
            'image' => $fileName,
        ];
    }
}
