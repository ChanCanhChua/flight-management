<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('client.pages.register');  // View: resources/views/client/pages/register.blade.php
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 5 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Tạo user mới với role mặc định là 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Gán mặc định role là 'user'
        ]);

        // Chuyển hướng về trang đăng nhập
        return redirect()->route('login')->with('status', 'Tạo tài khoản thành công, vui lòng đăng nhập');
    }
}
