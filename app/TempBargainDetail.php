<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempBargainDetail extends Model
{
    protected $table = 'temp_bargain_details';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'unit_price', 'bargain_price', 'temp_bargain_id'];
    public $timestamps = false;
}
