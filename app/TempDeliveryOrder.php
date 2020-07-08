<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempDeliveryOrder extends Model
{
    protected $table = 'temp_delivery_orders';
    protected $primaryKey = 'temp_do_id';
    protected $fillable = ['temp_do_id', 'do_id', 'do_num', 'po_id', 'do_date', 'do_sender', 'do_receiver', 'do_deliveryman', 'do_note', 'id_user'];
}
