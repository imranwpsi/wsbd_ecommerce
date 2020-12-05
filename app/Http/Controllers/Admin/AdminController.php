<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller {
	public function index() {
		return view('admin.index');
	}

	public function language(Request $request) {
		App::setLocale($request->language);
		session()->put('language', $request->language);
		return back();
	}
}
