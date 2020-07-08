<?php

namespace App\Http\Controllers;

use App\Supplier;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppliers.supplier', [
            'pageTitle' => 'Suppliers Management',
            'suppliers' => $suppliers
        ]);
    }
    public function create()
    {
        return view('suppliers.create', [
            'pageTitle' => 'Suppliers Management'
        ]);
    }

    public function store()
    {

        $supplierData = [
            'sup_name' => request('sup_name'),
            'sup_desc' => request('sup_desc'),
            'sup_address' => request('sup_address'),
            'sup_address2' => request('sup_address2'),
            'sup_cp' => request('sup_cp'),
            'sup_cp2'=> request('sup_cp2'),
            'sup_rek_giro' => request('sup_rek_giro')
        ];

        try {
            Supplier::create($supplierData);

            return redirect('suppliers')->with('Success', 'Supplier baru berhasil di tambahkan');
        } catch (\Exception $th) {
            //throw $th;

            return redirect()->back()->with('Error', 'Tidak dapat terhubung ke database');
        }
    }

    public function show($sup_id)
    {

        $supplier = Supplier::where('sup_id', $sup_id)->first();

        return view('suppliers.edit',[
            'pageTitle' => 'Edit Supplier',
            'supplier' => $supplier
        ]);

    }

    public function update($sup_id)
    {
        $supplierData = [
            'sup_name' => request('sup_name'),
            'sup_desc' => request('sup_desc'),
            'sup_address' => request('sup_address'),
            'sup_address2' => request('sup_address2'),
            'sup_cp' => request('sup_cp'),
            'sup_cp2'=> request('sup_cp2'),
            'sup_rek_giro' => request('sup_rek_giro')
        ];

        try {
            Supplier::where('sup_id', $sup_id)->update($supplierData);

            return redirect('/suppliers')->with('Success', 'Supplier berhasil di edit!!');
        } catch (Exception $th) {
            throw $th;
            return redirect()->back()->with('Error', 'Gagal, Tidak dapat terhubung ke database');
            
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
