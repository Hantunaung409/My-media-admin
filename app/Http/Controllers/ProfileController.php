<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct to admin Profile Page
    public function index(){
        $id = Auth::user()->id;
        $userData = User::select('id','name','email','phone','gender','address')->where('id',$id)->first(); //MVC pattern
        return view('admin.profile.index',compact('userData'));
    }

    // admin profile infos update
    public function profileEdit(Request $request){
        $userData = $this->getAdminInfo($request);
        $validator = $this->adminInfoValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        User::where('id',Auth::user()->id)
              ->update($userData);
        return back()->with(['updateSuccess' => 'Your Infos were updated Successfully!']);
    }
    //direct password changing page
    public function changePasswordPage(){
        return view('admin.profile.changePasswordPage');
    }
    //changing password
    public function changePassword(Request $request){
      $dbData = User::select('password')->where('id',Auth::user()->id)->first();
      $dbPassword = $dbData->password;
      $hashedNewPassword = Hash::make($request->newPassword);
      $validator = $this->passwordValidationCheck($request);
      if($validator->fails()){
        return back()->withErrors($validator)->withInput();
      }

      if(Hash::check($request->oldPassword, $dbPassword)){
        User::where('id',Auth::user()->id)->update([
            'password' => $hashedNewPassword,
        ]);
       return redirect()->route('dashboard');
      }else{
        return back()->with(['fail' => 'Old Password do not match!Please Try Again']);
      }

    }

    //get profile info
    private function getAdminInfo($request){
     return [
        'name' => $request->adminName,
        'email' => $request->adminEmail,
        'address' => $request->adminAddress,
        'phone' => $request->adminPhone,
        'gender' => $request->adminGender
     ];
    }

    //admin info validation check
    private function adminInfoValidationCheck($request){
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ]);
    }

    //password validation check
    private function passwordValidationCheck($request){
      return Validator::make($request->all(),[
        'oldPassword' => 'required',
        'newPassword' => 'required|min:6',
        'confirmPassword' => 'required|same:newPassword'
      ],[
        'confirmPassword.same' => 'Passwords did not match'
      ]);
    }
}
