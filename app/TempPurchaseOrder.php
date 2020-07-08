<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPurchaseOrder extends Model
{
    protected $table = 'temp_purchase_orders';
    protected $primaryKey = 'temp_po_id';
    protected $fillable = ['po_id', 'sup_id', 'discount', 'type', 'date', 'note', 'id_user', 'expr'];
    public $timestamps = false;
}
 