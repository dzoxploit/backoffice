<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BargainDetail extends Model
{
    protected $table = 'bargain_details';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'unit_price', 'bargain_price', 'bargain_id'];
}
