<?php

namespace App\Http\Controllers\Sales;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('sales.customer.customers', [
            'pageTitle' => 'Halaman Customer',
            'customers' => $customers
        ]);
    }

    public function create()
    {
        return view('sales.customer.create', [
            'pageTitle' => 'Tambah Pelanggan'
        ]);
    }

    public function store()
    {
        $customerData = [
            'fullname' => request('customer-name'), 
            'address' => request('customer-address'),
            'no_telp' => request('customer-no-telp'),
            'company' => request('customer-company'),
            'department' => request('customer-department')
        ];

        Customer::create($customerData);

        return redirect('/sales/customers')->with('success', 'data berhasil dimasukan');
    }

    public function show($customer_id)
    {
        $customer = Customer::where('customer_id', $customer_id)->first();

        return view('sales.customer.edit', [
            'pageTitle' => 'Tambah Pelanggan',
            'customer' => $customer
        ]);
    }

    public function edit($customer_id)
    {
        $customerData = [
            'fullname' => request('customer-name'), 
            'address' => request('customer-address'),
            'no_telp' => request('customer-no-telp'),
            'company' => request('customer-company'),
            'department' => request('customer-department')
        ];

        $customer = Customer::where('customer_id', $customer_id)->update($customerData);

        return redirect('/sales/customers')->with('success', 'Edit berhasil');
    }

    public function destroy($customer_id)
    {
        Customer::where('customer_id', $customer_id)->delete();

        return redirect()->back()->with('success', 'Delete Berhasil');
    }
}
