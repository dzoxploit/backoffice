<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempDetailDeliveryOrder extends Model
{
    protected $table = 'temp_detail_delivery_orders';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'note', 'temp_do_id'];
    public $timestamps = false;
}
