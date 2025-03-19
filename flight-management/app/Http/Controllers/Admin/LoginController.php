<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use App\ResponseTrait;
class LoginController extends Controller

{
    use ResponseTrait;
    public function showLoginForm()
    {
        
    }

    
    public function login(Request $request)
      
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if ($user = Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return $this->successResponse($user, 'Đăng nhap thành công!');
 
            //return redirect()->intended('dashboard');
        }


        dd($user);
       
        return $this->successResponse($user, 'Đăng ký thành công!');

    
    }

}
