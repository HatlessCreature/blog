<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\User;
use App\Mail\EmailVerificationNotification;


//Auth:: i auth()-> rade isto, samo moramo use ^

class AuthController extends Controller
{
    public function getRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['verification_token'] = Str::random(32);
        $newUser = User::create($data);

        Auth::login($newUser);

        Mail::to($newUser)->send(new EmailVerificationNotification($newUser));
        return redirect('/posts');
        // info($data);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function getLoginBlade()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/posts');
        }

        return view('auth.login', ['invalid_credentials' => true]);
    }
    //nema potrebe za nekom request validacijom ^

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();
        if (Auth::id() != $user->id) {
            return 'token ne pripada aktivnom koristniku';
        };
        $user->email_verified_at = now();
        $user->save();
        return redirect('/posts');
    }
}
