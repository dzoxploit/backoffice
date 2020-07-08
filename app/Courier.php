<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courier extends Model
{
    use SoftDeletes;
    
    protected $table = 'couriers';
    protected $primaryKey = 'courier_id';
    protected $fillable = ['courier_id', 'courier_name', 'courier_contact', 'courier_address'];
}
