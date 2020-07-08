<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDeliveryOrder extends Model
{
    protected $table = 'detail_delivery_orders';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'note', 'do_id'];
    public $timestamps = false;
}
