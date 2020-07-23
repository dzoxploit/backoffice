<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPurchaseOrderCustomer extends Model
{
    protected $table = 'temp_purchase_order_customers';
    protected $primaryKey = 'temp_po_id';
    protected $fillable = ['temp_po_id', 'po_id', 'po_num', 'bargain_id', 'customer_id', 'po_note', 'po_discount', 'po_discount_type', 'id_user','expr'];
    public $timestamps = false;
}
