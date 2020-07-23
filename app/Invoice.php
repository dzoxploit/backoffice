<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_id', 'no_invoice', 'invoice_attachment', 'po_id', 'po_id_format', 'confirm_date', 'due_date', 'note', 'ppn' , 'paid_price', 'id_user', 'paid_at'];
}
