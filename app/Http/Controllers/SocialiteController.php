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
    public function authProviderRedirect($provider)
    {
        if($provider) {
            return Socialite::driver($provider)->redirect();
        }
        abort(404);
        
    }
    public function socialAuthencation($provider)
    {
        
            try {

                if ($provider) {
                    
                    $socialUser = Socialite::driver($provider)->user();
            
                    $user = User::where('email', $socialUser->email)->first();
                    if ($user) {
            
                        Auth::login($user);
                        return redirect()->route('index');
                    }
                    else {
                        // Nếu người dùng chưa tồn tại trong hệ thống, tạo mới
                        $newUser = User::create([
                            'id' => $socialUser->id,
                            'name' => $socialUser->name,
                            'email' => $socialUser->email,
                            'password' => Hash::make('12345678'), // Tạo mật khẩu ngẫu nhiên
                            'avatar' => $socialUser->avatar,
                        ]);

                        if ($newUser) {
                            Auth::login($newUser);
                            return redirect()->route('index');
                        }
            
                    }

                
                
            
            }
            }
            catch (\Exception $e) {
                return redirect('/')->with('error', 'Đăng nhập thất bại. Vui lòng thử lại.');
            }


        

        
    }
    
}
