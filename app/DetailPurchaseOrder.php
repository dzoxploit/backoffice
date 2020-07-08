<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPurchaseOrder extends Model
{
    protected $table = 'detail_purchase_orders';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'price', 'discount', 'temp_po_id', 'po_id'];
    public $timestamps = false;
}
