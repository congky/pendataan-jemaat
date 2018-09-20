<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;
use Session;

class LoginController extends Controller
{

    public function viewLogin() {
        return view("login.login");
    }

    public function doLogin(Request $request) {

        $username = $request->get("username");
        $password = $request->get("password");

        $user = Users::where("username", $username)->first();

        if(!is_null($user)) {

            if($user->password != md5($password)) {
                return redirect()->back()->with("message", "Password tidak cocok");
            }

            Session::put("HAS_SESSION", [
                "user_id" => $user->user_id,
                "role" => $user->role,
                "username" => $user->username,
                "anggota_id" => $user->anggota_id
            ]);

            return redirect("/home");
        } else {
            return redirect()->back()->with("message", "Username tidak cocok");
        }

    }

    public function doLogout() {
        Session::flush("HAS_SESSION");
        return redirect("/");
    }

}
