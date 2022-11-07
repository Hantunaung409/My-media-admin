<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //direct admin list page
    public function index(){
        $userData = User::select('id','name','email','phone','address','gender')->get();
        return view('admin.list.index',compact('userData'));
    }
    //delete admin list
    public function delete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess' => 'A user account was deleted!']);
    }
    // //list search
    // public function listSearch(Request $request){
    //    $userData = User::orWhere('name','like','%'.$request->adminSearch.'%')
    //                     ->orWhere('email','like','%'.$request->adminSearch.'%')
    //                     ->orWhere('phone','like','%'.$request->adminSearch.'%')
    //                     ->orWhere('address','like','%'.$request->adminSearch.'%')
    //                     ->orWhere('gender','like','%'.$request->adminSearch.'%')
    //                     ->get();
    //   return view('admin.list.index',compact('userData'));
    // }
        //list search
        public function listSearch(){
            $userData = User::when(request('adminSearch'),function($query){
                $query->orWhere('name','like','%'.request('adminSearch').'%')
                      ->orWhere('email','like','%'.request('adminSearch').'%')
                      ->orWhere('phone','like','%'.request('adminSearch').'%')
                      ->orWhere('address','like','%'.request('adminSearch').'%')
                      ->orWhere('gender','like','%'.request('adminSearch').'%');
            })->get();
           return view('admin.list.index',compact('userData'));
         }
}
