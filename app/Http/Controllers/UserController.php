<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPassword;
use App\Role;
use App\User;
use App\UserPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.role_id')->select('id_user','username', 'fullname', 'contact', 'role_name')->paginate(10);

        return view('users.user', [
            'pageTitle' => 'Users Management',
            'users' => $users
        ]);
    }

    public function create()
    {
        $role = Role::all();

        return view('users.create', [
            'pageTitle' => 'Create New User',
            'roles' => $role
        ]);
    }

    public function roles()
    {
        $role = Role::all();

        return view('roles.role', [
            'pageTitle' => 'Roles',
            'roles' => $role
        ]);
    }

    public function storeRole()
    {
        $role = [
            'role_name' => request('role')
        ];

        Role::create($role);

        return redirect()->back();
    }

    public function destroyRole($role_id)
    {
        Role::where('role_id', $role_id)->delete();

        return redirect()->back();
    }

    public function getRoles()
    {
        $role = Role::all();
    
        return response([
            'message' => 'roles_obtained',
            'roles' => $role
        ]);
    }

    public function store(Request $request)
    {
        $userData = [
            'username' => $request->input('username'),
            'fullname' => $request->input('fullname'),
            'contact' => $request->input('contact'),
            'role_id' => $request->input('role'),
            'password' => Hash::make($request->input('password'))
        ];

        User::create($userData);

        return redirect('/users')->with('Success', 'User berhasil di daftarkan!!');       
    }

    public function show($id_user)
    {
        $user = User::select('id_user', 'username', 'fullname', 'contact', 'role_id')->where('id_user', $id_user)->first();

        $role = Role::all();

        return view('users.edit', [
            'pageTitle' => 'Edit User',
            'user' => $user,
            'roles' => $role
        ]);    
    }

    public function update($id_user)
    {
        $userData = [
            'username' => request('username'),
            'fullname' => request('fullname'),
            'contact' => request('contact'),
            'role_id' => request('role'),
        ];

        try {
            User::where('id_user', $id_user)->update($userData);

            return redirect('/users')->with('Success', 'User berhasil di edit!!');
        } catch (Exception $th) {
            return redirect()->back()->with('Error', 'Gagal, Tidak dapat terhubung ke database');
            //throw $th;
        }
    }

    public function destroy($id_user)
    {
        try {
            User::where('id_user', $id_user)->delete();

            return redirect()->back()->with('Success', 'User berhasil di hapus');
        } catch (Exception $th) {
            return redirect()->back()->with('Error', 'Hapus gagal, Tidak dapat terhubung ke database');
        }
    }

    public function showChangePassword()
    {
        return view('users.change-password', [
            'pageTitle' => 'Change Password',
        ]);
    }

    public function changePassword(UpdateUserPassword $request, $id_user)
    {        
        //samain password yang di db sama current_password yang di request
        $user = User::select('id_user', 'password')->where('id_user', $id_user)->first();

        if (Hash::check($request->current_password, $user->password)) {
            //kalo sama di update ajah semua datanya
            $userPasswordData = [
                'password' => $request->password, 
                'old_password' => $user->password, 
            ];
            UserPassword::where('id_user', $user->id_user)->update($userPasswordData);
        }else {
            //kalo nggk sama return error
            
        }
        
    }
}
