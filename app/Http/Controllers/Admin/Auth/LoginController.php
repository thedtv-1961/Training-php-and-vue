<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $data = $request->only([
            'email',
            'password',
        ]);

        $authenticated = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($authenticated) {
            return redirect()->route('admin-home');
        }

        return redirect()->back()->with('error', trans('auth.failed'));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();

        return redirect()->route('getLogin');
    }
}
