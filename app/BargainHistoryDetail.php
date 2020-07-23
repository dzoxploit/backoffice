<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BargainHistoryDetail extends Model
{
    protected $table = 'bargain_history_details';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'unit_price', 'bargain_price', 'history_bargain_id'];
}
