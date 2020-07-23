<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BargainHistory extends Model
{
    use SoftDeletes;

    protected $table = 'bargain_histories';
    protected $primaryKey = 'history_bargain_id';
    protected $fillable = ['history_bargain_id', 'bargain_id', 'customer_id', 'created_by', 'updated_by', 'discount', 'discount_type', 'bargain_expr', 'bargain_note', 'bargain_closed'];
}
