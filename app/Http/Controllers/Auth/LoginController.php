<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:member')->except('logout');
    }

    /**
     * Custom function.
     *
     * @return void
     */
    public function showUserLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    /**
     * Custom function.
     *
     * @return void
     */
    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Custom function.
     *
     * @return void
     */
    public function showMemberLoginForm()
    {
        return view('auth.login', ['url' => 'member']);
    }
    
    /**
     * Custom function.
     *
     * @return void
     */
    public function memberLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/member');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Custom function.
     *
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        Auth::guard('member')->logout();
        Auth::guard('web')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }
}
