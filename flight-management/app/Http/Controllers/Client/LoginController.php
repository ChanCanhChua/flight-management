<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect()->route('client.pages.home'); // Đảm bảo route này đã được định nghĩa trong routes/web.php
        } else {
            return view('client.pages.login');
        }
    }

    public function postLogin(Request $request)
    {
        // Chỉ cần email và password để xác thực, không cần thêm status
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            // Sau khi đăng nhập thành công, chuyển hướng đến trang home
            return redirect()->route('client.pages.home')->with('name', Auth::user()->name);
        } else {
            // Nếu đăng nhập không thành công, quay lại trang login với thông báo lỗi
            return redirect()->back()->with('status', 'Email hoặc mật khẩu không đúng');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('client.pages.home');  // Hoặc trang bạn muốn chuyển hướng sau khi đăng xuất
    }

}
