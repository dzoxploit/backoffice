<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{

    use SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = ['id_user', 'username', 'password', 'fullname', 'contact', 'role_id'];
}
