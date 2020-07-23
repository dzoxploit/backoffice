<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bargain extends Model
{
    use SoftDeletes;

    protected $table = 'bargains';
    protected $primaryKey = 'bargain_id';
    protected $fillable = ['bargain_id', 'bargain_id_format', 'customer_id', 'created_by', 'updated_by', 'discount', 'discount_type', 'bargain_expr', 'bargain_note', 'bargain_closed'];
}
