<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function getLogin()
     {
       return view('admin.Auth.login');

     }

     public function saveAdmin()
     {
         //write this command in tinker,Admin user credintial
           /*  $admin=new App\Models\Admin();
            $admin->name="barakat alrashdan";
            $admin->email="barakatalrashdan@ymail.com";
            $admin->password=bcrypt('admin');
            $admin->save(); */

     }
     public function login(LoginRequest $request)
     {
         $remember_me=$request->has('remember_me');
         if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
         {

             return redirect()->route('admin.dashboard');
         }
         return redirect()->back()->with(['error'=>'بيانات دخول الادمن غير صحيحية']);

     }
}
