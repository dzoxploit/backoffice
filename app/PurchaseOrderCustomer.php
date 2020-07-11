<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderCustomer extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order_customers';
    protected $primaryKey = 'po_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['po_id', 'po_num', 'id_penawaran', 'customer_id', 'po_note', 'po_discount', 'po_discount_type', 'id_user'];
}
