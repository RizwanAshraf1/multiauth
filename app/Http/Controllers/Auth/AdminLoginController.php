<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\MessageBag;

class AdminLoginController extends Controller
{
  
    public function __construct()
    {
        $this->middleware("guest:admin")->except('logout');
    }
    public function loginForm()
    {
        return view("admins.login");
    }
    public function login(Request $request)
    {
        
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required|min:6",
        ]);

        if (Auth::guard("admin")->attempt(["email" => $request->email, "password" => $request->password], $request->remember)) {

            return redirect()->intended(route("admin.dashboard"));
        }

        return back()->withInput($request->only("email","remember"))->with("invalid","Invalid Credentials.");

 }
 public function logout(Request $request) {
    Auth::guard("admin")->logout();
    return redirect('/');
  }
}
