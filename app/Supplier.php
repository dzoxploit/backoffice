<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'Suppliers';
    protected $primaryKey = 'sup_id';
    protected $fillable = ['sup_id', 'sup_name', 'sup_desc', 'sup_address', 'sup_address2', 'sup_cp', 'sup_cp2', 'sup_rek_giro'];
}
