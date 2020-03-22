<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:user');
        $this->middleware('guest:member');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  string  $type
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $type)
    {
        switch ($type) {
            case 'member':
                return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
                    'phone' => ['required', 'string', 'min:10'],
                    'password' => ['required', 'string', 'min:4', 'confirmed'],
                ]);
                break;
            case 'user':
                return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:4', 'confirmed'],
                    'role' => ['required', 'string'],
                ]);
                break;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Member
     */
    protected function create(array $data)
    {
        return Member::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Custom function.
     * 
     */
    public function showUserRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    /**
     * Custom function.
     * 
     */
    public function showMemberRegisterForm()
    {
        return view('auth.register', ['url' => 'member']);
    }


    /**
     * Custom function.
     * 
     */
    protected function createUser(Request $request)
    {
        $this->validator($request->all(), 'user')->validate();
        $user = User::create([
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => 'super_admin',
        ]);
        return redirect()->intended('login/admin');
    }

    /**
     * Custom function.
     * 
     */
    protected function createMember(Request $request)
    {
        $this->validator($request->all(), 'member')->validate();
        $member = Member::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/member');
    }
}
