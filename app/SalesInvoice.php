<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'sales_invoices';
    protected $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_id', 'invoice_id_format', 'po_id', 'bill_to', 'ship_to', 'tax_invoice', 'terms', 'due_date' , 'ship_via', 'ship_date', 'spell', 'ppn', 'freight', 'notes', 'payment_method', 'paid_at'];
}
