<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertPurchaseOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'purchase_po_id_romawi' => '', 
            'purchase_po_id_year' => '',
            'purchase_supplier_id' => 'required',
            'purchase_po_discount' => '',
            'purchase_po_discount_type' => '',
            'ppn' => '',
            'purchase_po_date' => 'required',
            'purchase_po_note',
            'purchase_syarat_pemabayaran' => 'required',
            'purchase_contact_person' => 'required',
            'purchase_po_request',
            'purchase_po_delivery_date' => 'required',
            'purchase_po_tempat_penyerahan' => 'required',
            'purchase_po_yang_membuat' => 'required',
            'purchase_po_yang_menyetujui' => ''
        ];
    }
}
