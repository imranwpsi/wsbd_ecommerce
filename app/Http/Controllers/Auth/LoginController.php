<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {

	use AuthenticatesUsers;

	public function showAdminLoginForm() {
		return view('auth/login', ['url' => 'admin']);
	}

	public function adminLogin(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6',
		]);

		if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

			return redirect()->intended('/admin');
		}
		return back()->withInput($request->only('email', 'remember'));
	}

	protected $redirectTo = RouteServiceProvider::HOME;

	public function __construct() {
		$this->middleware('guest')->except('logout');
		$this->middleware('guest:admin')->except('logout');
	}
}
