<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempDetailPurchaseOrderCustomer extends Model
{
    protected $table = 'temp_detail_purchase_order_customers';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'unit_price', 'temp_po_id'];
    public $timestamps = false;
}
