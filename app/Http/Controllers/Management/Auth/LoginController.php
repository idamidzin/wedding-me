<?php

namespace App\Http\Controllers\Management\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/management';

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('management.auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()
                ->with('msg', [
                    'type' => 'danger',
                    'text' => 'Username dan Password Tidak Cocok!'
                ])
                ->withInput();    
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('mgt.dashboard');
        }

        return back()
            ->with('msg', [
                    'type' => 'danger',
                    'text'=>'Username dan Password Tidak Cocok!'
                ])
            ->withInput();
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('mgt.login');
    }
}
