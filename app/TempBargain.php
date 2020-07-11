<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempBargain extends Model
{
    protected $table = 'temp_bargains';
    protected $primaryKey = 'temp_bargain_id';
    protected $fillable = ['bargain_id', 'customer_id', 'discount', 'discount_type',  'bargain_expr', 'bargain_note', 'temp_expr'];
    public $timestamps = false;
}
