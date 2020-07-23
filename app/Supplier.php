<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'suppliers';
    protected $primaryKey = 'sup_id';
    protected $fillable = [
        'sup_name',
        'sup_email',
        'sup_address',
        'sup_address2',
        'sup_desc',
        'cp_name',
        'cp_telp',
        'cp_email',
        'sup_bank_rekening',
        'sup_bank_name',
        'sup_bank_cabang',
        'sup_bank_an',
        'sup_npwp'
    ];
}
