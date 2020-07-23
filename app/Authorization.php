<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Authorization extends Model
{
    use SoftDeletes;

    protected $table = 'authorizations';
    protected $primaryKey = 'authorization_id';
    protected $fillable = ['authorization_name', 'authorization_type'];
}
