<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempDetailPurchaseOrder extends Model
{
    protected $table = 'temp_detail_purchase_orders';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['product_id', 'product_name', 'qty', 'unit', 'unit_price', 'discount', 'temp_po_id'];
    public $timestamps = false;
}
