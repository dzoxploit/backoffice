<?php

namespace App\Http\Controllers;

use App\Authorization;
use App\Http\Requests\InsertMasterAuthorization;
use App\Http\Requests\UpdateMasterAuthorization;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function index()
    {
        $authorizations = Authorization::paginate(10);
        return view('authorizations.authorization', [
            'pageTitle' => 'Manajemen Otorisasi',
            'authorizations' => $authorizations
        ]);
    }

    public function create()
    {
        return view('authorizations.create', [
            'pageTitle' => 'Tambah Otorisasi Baru'
        ]);
    }

    public function store(InsertMasterAuthorization $request)
    {
        $authorizationData = [
            'authorization_name' => $request->input('authorization_name'), 
            'authorization_type' => $request->input('authorization_type'),
        ];

        Authorization::create($authorizationData);

        return redirect('/authorizations')->with('success', 'Otoritas berhasil di buat');
    }

    public function show($authorization_id)
    {
        $authorization = Authorization::where('authorization_id', $authorization_id)->first();

        return view('authorizations.edit', [
            'pageTitle' => 'Edit Otorisasi',
            'authorization' => $authorization
        ]);
    }
    
    public function update($authorization_id, UpdateMasterAuthorization $request) {
        $authorizationData = [
            'authorization_name' => $request->input('authorization_name'), 
            'authorization_type' => $request->input('authorization_type'),
        ];

        Authorization::where('authorization_id', $authorization_id)->update($authorizationData);

        return redirect('/authorizations')->with('success', 'Otoritas berhasil di ubah');
    }
}
