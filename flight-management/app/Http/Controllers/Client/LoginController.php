<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Login;

use Illuminate\Http\Request;



class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {

            return redirect()->route('clien.pages.Home');
        } else {
            
            return view('client.pages.login');
        }
    }


    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1,
        ];

        if (Auth::attempt($login)) {
            // Chuyển hướng đến trang dashboard hoặc bất kỳ trang nào bạn mong muốn
            return redirect()->route('dashboard')->with('name', Auth::user()->name);
        } else {
            // Trả về lại trang login với thông báo lỗi
            return redirect()->back()->with('status', 'Email hoặc mật khẩu không đúng');
        }
    }
}
