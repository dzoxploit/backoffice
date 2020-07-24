<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertSupplier;
use App\Http\Requests\UpdateSupplier;
use App\Supplier;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);

        return view('suppliers.supplier', [
            'pageTitle' => 'Manajemen Vendor',
            'suppliers' => $suppliers
        ]);
    }
    public function create()
    {
        return view('suppliers.create', [
            'pageTitle' => 'Manajemen Vendor'
        ]);
    }

    public function store(InsertSupplier $request)
    {
        $supplierData = [
            'sup_name' => $request->input('sup_name'),
            'sup_email' => $request->input('sup_email'),
            'sup_address' => $request->input('sup_address'),
            'sup_address2' => $request->input('sup_address2'),
            'sup_desc' => $request->input('sup_desc'),
            'cp_name' => $request->input('cp_name'),
            'cp_telp' => $request->input('cp_telp'),
            'cp_email' => $request->input('cp_email'),
            'sup_bank_rekening' => $request->input('sup_bank_rekening'),
            'sup_bank_name' => $request->input('sup_bank_name'),
            'sup_bank_cabang' => $request->input('sup_bank_cabang'),
            'sup_bank_an' => $request->input('sup_bank_an'),
            'sup_npwp' => $request->input('sup_npwp')
        ];

        Supplier::create($supplierData);

        return redirect('suppliers')->with('Success', 'Supplier baru berhasil di tambahkan');
    }

    public function detail($sup_id)
    {
        $supplier = Supplier::where('sup_id', $sup_id)->first();

        return view('suppliers.detail', [
            'pageTitle' => 'Data Vendor',
            'supplier' => $supplier
        ]);
    }

    public function show($sup_id)
    {

        $supplier = Supplier::where('sup_id', $sup_id)->first();

        return view('suppliers.edit',[
            'pageTitle' => 'Ubah Supplier',
            'supplier' => $supplier
        ]);

    }

    public function update(UpdateSupplier $request , $sup_id)
    {
        $supplierData = [
            'sup_name' => $request->input('sup_name'),
            'sup_email' => $request->input('sup_email'),
            'sup_address' => $request->input('sup_address'),
            'sup_address2' => $request->input('sup_address2'),
            'sup_desc' => $request->input('sup_desc'),
            'cp_name' => $request->input('cp_name'),
            'cp_telp' => $request->input('cp_telp'),
            'cp_email' => $request->input('cp_email'),
            'sup_bank_rekening' => $request->input('sup_bank_rekening'),
            'sup_bank_name' => $request->input('sup_bank_name'),
            'sup_bank_cabang' => $request->input('sup_bank_cabang'),
            'sup_bank_an' => $request->input('sup_bank_an'),
            'sup_npwp' => $request->input('sup_npwp')
        ];

        try {
            Supplier::where('sup_id', $sup_id)->update($supplierData);
            return redirect('/suppliers')->with('Success', 'Supplier berhasil di edit!!');
        } catch (Exception $th) {
            throw $th;
            return redirect()->back()->with('Error', 'Gagal');
        }

    }

    public function destroy($sup_id)
    {
        try {
            Supplier::where('sup_id', $sup_id)->delete();

            return redirect()->back()->with('Success', 'Supplier berhasil di hapus');
        } catch (Exception $th) {
            return redirect()->back()->with('Error', 'Hapus gagal, Tidak dapat terhubung ke database');
        }
    }
}
