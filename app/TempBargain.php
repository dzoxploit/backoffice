<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempBargain extends Model
{
    protected $table = 'temp_bargains';
    protected $primaryKey = 'temp_bargain_id';
    protected $fillable = ['temp_bargain_id', 'bargain_id', 'bargain_id_format', 'customer_id', 'created_by', 'updated_by', 'discount', 'discount_type', 'action', 'status' ,'bargain_expr', 'bargain_note', 'temp_expr'];
    public $timestamps = false;
}
