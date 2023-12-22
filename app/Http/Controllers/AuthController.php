<?php

namespace App\Http\Controllers;

use App\Helper\RedirectHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  public function login(Request $request) {
    if ($request->isMethod('POST')) {
      $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:' . User::$minimumPasswordLength
      ]);

      $credential = $request->only('email', 'password');

      if (Auth::attempt($credential)) {
        if (\auth()->user()->status !== User::$statusArrays[1]) {
          Auth::logout();
          \Illuminate\Support\Facades\Session::flush();
          return RedirectHelper::backWithInput('<strong>Sorry!!!</strong> Your not a active user.');
        }
        return RedirectHelper::routeSuccess('admin.dashboard', '<strong>Congratulations!!!</strong>');
      }
      return RedirectHelper::backWithInput('<strong>Sorry!!!</strong> Your email or password is wrong.');
    }
    return view('admin.auth.login');
  }

}
