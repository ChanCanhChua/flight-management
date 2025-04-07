<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // Sử dụng model Admin thay vì User
use App\ResponseTrait;

class LoginController extends Controller
{
    use ResponseTrait;

    /**
     * Hiển thị form đăng nhập admin
     */
    public function showLoginForm()
    {
        return view('admin.auth.login'); // Đảm bảo có view tương ứng
    }

    /**
     * Xử lý đăng nhập admin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Sử dụng guard('admin') thay vì attempt() thông thường
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
    
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác',
        ]);
        
    }

    /**
     * Đăng xuất admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}