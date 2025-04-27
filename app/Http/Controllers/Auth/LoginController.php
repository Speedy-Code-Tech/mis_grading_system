<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password','role');
    
        // First check if the email exists and is an admin
        $user = User::where('email', $credentials['email'])->first();
    
        if (!$user || $user->role !== $credentials['role']) {
            return back()->withErrors([
                'email' => 'You are not authorized to login here.',
            ]);
        }
    
        // If user is admin, attempt to login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            if($user->role=='admin'){
                return redirect()->intended('/admin/dashboard');
                
            }else if($user->role=='student'){
                return redirect()->intended('/student/dashboard');
                
            }else if($user->role=='teacher'){
            return redirect()->intended('/teacher/dashboard');
                
            }else if($user->role=='head_teacher'){
            return redirect()->intended('/head/dashboard');
                
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
}
