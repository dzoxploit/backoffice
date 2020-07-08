<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_orders';
    protected $primaryKey = 'po_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['po_id', 'sup_id', 'discount', 'type', 'date', 'note', 'id_user'];
}
