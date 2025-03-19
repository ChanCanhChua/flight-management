<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    function loginView()
    {
        return view("admin.pages.login");
    }

    function registerView()
    {
        return view("admin.pages.register");
    }

    function doLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',   
            'password' => 'required', 

        ]); 
        if ($validator->fails())   
        {

            return back()->withInput()->withErrors($validator);
           

        } else {
            
            if (Auth::attempt($request->only(["email", "password"]))) {
                return view("admin.pages.dashboard");
            } else {
                return back()->withErrors( "Invalid credentials"); 
            }
        }
    }

    function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',   
            'password' => 'required|min:8', 
            'confirm_password' => 'required|same:password',

        ]); 
        if ($validator->fails())   
        {

            return back()->withInput()->withErrors($validator);
          

        } else {
            
            $User = new User;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->save();

            return redirect("admin.pages.login")->with('success', 'You have successfully registered, Login to access your dashboard');
        }
    }
    

    
    function logout()
    {
        
        Auth::logout();

        return redirect("admin/login")->with('success', 'Logout successfully');
    }
}
