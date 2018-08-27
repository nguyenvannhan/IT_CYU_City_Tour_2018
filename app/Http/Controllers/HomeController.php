<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function getLogin() {
        if(Auth::check()) {
            if(Auth::user()->role_id == 1) {
                return redirect('/tram-truong/thong-tin');
            }
            if(Auth::user()->role_id == 0) {
                return redirect('/doi-choi');
            }
        }
        return view('login');
    }

    public function postLogin(Request $request) {
        $username = $request->username;
        $password = $request->pass;
        $remember = $request->remember;

        if(Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            if(Auth::user()->role_id == 1) {
                return redirect('/tram-truong/thong-tin');
            }
            if(Auth::user()->role_id == 0) {
                return redirect('/doi-choi');
            }
        } else {
            return back()->with(['error' => 'Sai tài khoản hoặc mật khẩu']);
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('get_login_route');
    }
}
