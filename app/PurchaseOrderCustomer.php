<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderCustomer extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order_customers';
    protected $primaryKey = 'po_id';
    protected $fillable = ['po_id', 'po_id_format', 'po_num', 'bargain_id', 'customer_id', 'po_note', 'po_discount', 'po_discount_type', 'po_attachment',  'id_user'];
}
