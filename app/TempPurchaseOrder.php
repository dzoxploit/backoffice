<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPurchaseOrder extends Model
{
    protected $table = 'temp_purchase_orders';
    protected $primaryKey = 'temp_po_id';
    protected $fillable = ['po_id_format', 'sup_id', 'discount', 'type', 'ppn',  'date', 'note', 'payment_term','contact_person', 'po_request', 'delivery_date', 'delivery_point', 'id_user', 'expr'];
    public $timestamps = false;
}
 