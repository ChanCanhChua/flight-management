<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;




use App\ResponseTrait;
class UserController extends Controller
{
    use ResponseTrait;
    public function addUser() {
        ;

        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
           
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('failed', $validator->errors()->all());
        }

        $data = request()->only(['email', 'password']);

        $user = User::where('email', $data['email'])->first();

        if($user){
            return $this->errorResponse('Email đã có người đăng ký.', ['Email đã có người đăng ký.']);
        }

        $data['password'] = Hash::make($data['password']); 

     
        $user = new User();
        $user->email =  $data['email'];
        $user->password = $data['password'];
        $user->name =  $data['email'];
        $user->save();

       
        return $this->successResponse($user, 'Đăng ký thành công!');

    
    }
}
