<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertMasterUnit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return view('master.unit.unit', [
            'pageTitle' => 'Manajemen Unit Barang'
        ]);
    }

    public function store(InsertMasterUnit $request)
    {

    }
}
