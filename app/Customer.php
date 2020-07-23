<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_id', 'fullname', 'address', 'no_telp', 'company', 'department', 'warehouse_address'];
}
