<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryOrder extends Model
{
    use SoftDeletes;

    protected $table = 'delivery_orders';
    protected $primaryKey = 'do_id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['do_id', 'do_num', 'po_id', 'do_date', 'do_sender', 'do_receiver', 'do_deliveryman', 'do_note', 'id_user'];

    public function detailDo()
    {
        return $this->hasMany('App\DetailDeliveryOrder', 'do_id');
    }
}
