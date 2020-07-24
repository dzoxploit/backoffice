<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiIndexController extends Controller
{
    public function index(){
        $out = [
            'messages' => 'selamat datang di Api Mobile Backoffice Dunia murah',
            'status' => 201
        ];
        return response()->json($out);
    }
}
