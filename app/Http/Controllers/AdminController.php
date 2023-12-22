<?php

namespace App\Http\Controllers;

use App\Helper\CustomHelper;
use App\Models\District;
use App\Models\Division;
use App\Models\Training;
use App\Models\User;
use App\Rules\MatchOldPasswordRule;
use App\Rules\MinWordsRule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function logout()
  {
    \auth()->logout();
    \session()->flush();
    return redirect()->route('login');
  }
  public function index()
  {
    return view('admin.index');
  }
  public function profile()
  {
     return view('admin.profile');
  }

  public function profileUpdate(Request $request)
  {
    $request->validate([
      'email' => 'required|email|unique:' . with(new User)->getTable() . ',email,' . auth()->id(),
      'phone' => 'required|regex:' . CustomHelper::PhoneNoRegex,
      'name' => 'required|string',
    ]);

    $data  = $request->only(['email','phone','name']);
//    return $data;

    try{

     auth()->user()->update($data);
    }catch (\Exception $e){
      return $e;
    }
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                <strong>Congratulation !!!</strong> Profile updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    return redirect()->back()->with('updateProfile', $status);
  }

  public function passwordUpdate(Request $request)
  {
    $request->validate([
      'current_password' => ['required', 'string', 'min:' . User::$minimumPasswordLength, new MatchOldPasswordRule()],
      'password' => 'required|string|min:' . User::$minimumPasswordLength,
      'password_confirmation' => 'required|string|min:' . User::$minimumPasswordLength . '|same:password'
    ]);
    \auth()->user()->update(['password'=>bcrypt($request->password)]);
    $status = '<div class="alert alert-success alert-dismissible show" role="alert">
                <strong>Congratulation !!!</strong> Password updated.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    return redirect()->back()->with('updatePassword', $status);
  }
}
