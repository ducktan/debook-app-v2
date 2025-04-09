<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SocialiteController extends Controller

{
    //
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleAuthencation()
    {
            try {

                $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->email)->first();
            if ($user) {
            
                Auth::login($user);
                return redirect()->route('index');
            }
            else {
                // Nếu người dùng chưa tồn tại trong hệ thống, tạo mới
                $newUser = User::create([
                    'id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make('12345678'), // Tạo mật khẩu ngẫu nhiên
                    'avatar' => $googleUser->avatar,
                ]);

                if ($newUser) {
                    Auth::login($newUser);
                    return redirect()->route('index');
                }
    
                
            
            }
            }
            catch (\Exception $e) {
                return redirect('/')->with('error', 'Đăng nhập thất bại. Vui lòng thử lại.');
            }


        

        
    }
    
}
