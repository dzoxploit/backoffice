<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPurchaseOrderCustomer extends Model
{
    protected $table = 'detail_purchase_order_customers';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'unit_price', 'po_id'];
    public $timestamps = false;
}
