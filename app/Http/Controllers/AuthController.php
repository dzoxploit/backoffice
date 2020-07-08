<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {

        if (session('status') == 'loggedin') {
            return redirect('/');
        }else {
            return view('LoginPage');
        }
        
    }

    public function login(Request $request)
    {

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::select('id_user', 'fullname' ,'username', 'password')->where('username', $username)->first();

        if ($this->userExist($username)) {
            if (Hash::check($password, $user->password)) {
                $sessionCreate = session([
                    'id_user' => $user->id_user,
                    'fullname' => $user->fullname,
                    'status' => 'loggedin'
                ]);

                return redirect('/');
            } else {
                return redirect()->back()->with('Error', 'Username atau Password salah');
            }
        } else {
            return redirect()->back()->with('Error', 'Username tidak terdaftar');
        }
    }

    public function userExist($username)
    {
        $user = User::where('username', $username)->count();

        if ($user > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session()->flush();
        
        return redirect('login');
    }
}
