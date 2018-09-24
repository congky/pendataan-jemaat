<?php

namespace App\Http\Controllers;

use App\Anggota;
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

            $anggota = Anggota::find($user->anggota_id);

            if($user->password != md5($password)) {
                return redirect()->back()->with("message", "Password tidak cocok");
            }

            Session::put("HAS_SESSION", [
                "user_id" => $user->user_id,
                "role" => $user->role,
                "username" => $user->username,
                "anggota_id" => $user->anggota_id,
                "nama_lengkap" => !is_null($anggota) ? $anggota->nama_lengkap : $user->username
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
