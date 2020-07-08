<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoices';
    protected $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_id', 'no_invoice', 'invoice_date', 'po_id', 'confirm_date', 'due_date', 'note', 'id_user'];
}
