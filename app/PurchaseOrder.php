<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_orders';
    protected $primaryKey = 'po_id';
    protected $fillable = ['po_id', 'po_id_format', 'sup_id', 'discount', 'type', 'ppn', 'date', 'note', 'payment_term', 'contact_person', 'po_request', 'delivery_date', 'delivery_point', 'po_maker', 'po_approver' ,'id_user'];
}
