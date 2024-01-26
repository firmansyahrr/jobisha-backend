<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            return $this->successResponse($success, 'User login successfully.');
        } else {
            return $this->failedResponse(null, 'Login Failed. Invalid Credentials.');
        }
    }

    public function showLogin(Request $request)
    {
        $isAuthenticated = $request->session()->get('app_token');
        if ($isAuthenticated) {
            return redirect()->route('home');
        }

        return view('login.main');
    }

    public function loginWeb(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role != 'super-admin') {
                return back()->with('error', 'Invalid Username and Password.');
            }

            
            $token = $user->createToken('MyApp')->plainTextToken;
            $request->session()->put('app_token', $token);
            $request->session()->put('authenticated', true);
            $request->session()->put('user', $user);

            return redirect()->route('home');
        } else {
            return back()->with('error', 'Invalid Username and Password.');
        }
    }
}
