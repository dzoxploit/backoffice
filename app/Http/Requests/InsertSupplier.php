<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertSupplier extends FormRequest
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
            'sup_name' => 'required', 
            'sup_email' => 'required', 
            'sup_address' => 'required',
            'sup_address2' => '',
            'sup_desc' => '',
            'cp_name' => 'required', 
            'cp_telp' => 'required',
            'cp_email' => 'required',
            'sup_bank_rekening' => 'required', 
            'sup_bank_name' => 'required', 
            'sup_bank_cabang' => 'required', 
            'sup_bank_an' => 'required',
            'sup_npwp' => 'required'
        ];
    }
}
