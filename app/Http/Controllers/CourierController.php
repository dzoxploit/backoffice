<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Supplier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();

         return view('sales.courier.couriers', [
            'pageTitle' => 'Courier Management',
            'couriers' => $couriers
        ]);
    }

    public function create()
    {
        return view('sales.courier.create', [
            'pageTitle' => 'Courier New'
        ]);
    }

    public function store()
    {
        $courierData = [
            'courier_name' => request('courier-name'),
            'courier_contact' => request('courier-contact'),
            'courier_address' => request('courier-address')
        ];

        Courier::create($courierData);

        return redirect('/couriers')->with('success', 'Courier Berhasil di tambah');
    }

    public function destroy($courier_id)
    {
        Courier::where('courier_id', $courier_id)->delete();

        return redirect()->back();
    }

    public function show($courier_id)
    {
        $courier = Courier::where('courier_id', $courier_id)->first();
        return view('sales.courier.edit', [
            'courier' => $courier
        ]);
    }

    public function update($courier_id)
    {
        $courierData = [
            'courier_name' => request('courier-name'),
            'courier_contact' => request('courier-contact'),
            'courier_address' => request('courier-address')
        ];

        Courier::where('courier_id', $courier_id)->update($courierData);

        return redirect('/couriers')->with('success', 'Courier Berhasil di update');
    }
}
