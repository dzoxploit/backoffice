<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuktiBayar extends Model
{
    protected $table = 'bukti_bayar';

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'invoice_id','paid','paid_date','confirm_date','payment_proof','payment_method','note'
    ];
}
