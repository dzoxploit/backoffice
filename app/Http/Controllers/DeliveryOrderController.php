<?php

namespace App\Http\Controllers;

use App\DeliveryOrder;
use App\DetailDeliveryOrder;
use App\DetailPurchaseOrder;
use App\Lib\DMlib;
use App\PurchaseOrder;
use App\Supplier;
use App\TempDeliveryOrder;
use App\TempDetailDeliveryOrder;
use Exception;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        $deliveryOrder = DeliveryOrder::all();

        return view('deliveryorders.delivery-order', [
            'pageTitle' => 'Delivery Orders',
            'deliveryOrder' => $deliveryOrder
        ]);
    }

    public function create()
    {

        if (session()->has('temp_do_id')) {
            $getTempDetailDo = TempDetailDeliveryOrder::where('temp_do_id', session('temp_do_id'))->get();
            $getTempDo = TempDeliveryOrder::where('temp_do_id', session('temp_do_id'))->first();
        } else {
            $getTempDo = [];
            $getTempDetailDo = [];
        }

        return view('deliveryorders.create', [
            'pageTitle' => 'New Delivery Order',
            'tempDo' => $getTempDo,
            'tempDetailDo' => $getTempDetailDo
        ]);
    }

    public function store()
    {
        $deliveryOrderData = [
            'do_id' => request('do-id'),
            'do_num' => request('do-num'),
            'po_id' => request('po-id'),
            'do_date' => request('do-date'),
            'do_sender' => request('do-sender'),
            'do_receiver' => request('do-receiver'),
            'do_deliveryman' => request('do-deliveryman'),
            'do_note' => request('do-note'),
            'id_user' => session('id_user'),
        ];

        $deliveryOrder = DeliveryOrder::create($deliveryOrderData);

        $tempDetailDo = TempDetailDeliveryOrder::where('temp_do_id', session('temp_do_id'))->get();

        foreach ($tempDetailDo as $tddo) {
            $tempDetailData = [
                'product_id' => $tddo->product_id,
                'product_name' => $tddo->product_name,
                'qty' => $tddo->qty,
                'note' => $tddo->note,
                'do_id' => $deliveryOrder->do_id
            ];

            DetailDeliveryOrder::create($tempDetailData);
        }

        TempDeliveryOrder::where('temp_do_id', session('temp_do_id'))->delete();
        TempDetailDeliveryOrder::where('temp_do_id', session('temp_do_id'))->delete();

        session()->forget('temp_po_id');

        return redirect('/deliveryorders')->with('success', 'Deliver Order Berhasil di buat');
    }

    public function detail($delivery_id)
    {
        $getDetailDo = DetailPurchaseOrder::where('do_id', $delivery_id)->get();
        $getDo = PurchaseOrder::where('do_id', $delivery_id)->first();
    
        return view('deliveryorders.detail', [
            'pageTitle' => 'New Delivery Order',
            'detailDo' => $getDetailDo,
            'do' => $getDo
        ]);
    }

    public function destroy($do_id)
    {
        try {
            DeliveryOrder::where('do_id', $do_id)->delete();

            return redirect()->back()->with('Success', 'Delivery Order berhasil di hapus');
        } catch (Exception $th) {
            return redirect()->back()->with('Error', 'Hapus gagal, Tidak dapat terhubung ke database');
        }
    }

    /**
     * Temporary
     * 
     */
    public function storeTemp()
    {

        $tempDeliveryOrderData = [
            'do_id' => request('do_id'),
            'do_num' => request('do_num'),
            'po_id' => request('po_id'),
            'do_date' => request('do_date'),
            'do_sender' => request('do_sender'),
            'do_receiver' => request('do_receiver'),
            'do_deliveryman' => request('do_deliveryman'),
            'do_note' => request('do_note'),
            'id_user' => session('id_user')
        ];

        $tempDeliveryOrder = TempDeliveryOrder::updateOrCreate(['temp_do_id' => session('temp_do_id')], $tempDeliveryOrderData);

        session()->put('temp_do_id', $tempDeliveryOrder->temp_do_id);

        return response([
            'message' => 'data_inserted'
        ], 200);
    }

    public function destroyTemp()
    {
        TempDeliveryOrder::where('temp_do_id', session('temp_do_id'))->delete();
        TempDetailDeliveryOrder::where('temp_do_id', session('temp_do_id'))->delete();

        session()->forget('temp_do_id');

        return redirect()->back();
    }

    /**
     * Temporary Detail
     * 
     */

    public function showProduct(DMlib $dmlib)
    {
        if (request('q')) {
            $product = $dmlib->getProductByName(request('q'));
        } else {
            $product = array();
        }

        return view('deliveryorders.product', [
            'pageTitle' => 'Add Product',
            'product' => $product 
        ]);
    }

    public function storeProduct(DMlib $dmlib, $product_id)
    {
        $getProduct = $dmlib->getProductById($product_id);

        $productData = array(
            'product_id' => $getProduct->prod_id,
            'product_name' => $getProduct->prod_name,
            'qty' => 1,
            'note' => null,
            'temp_do_id' => session('temp_do_id')
        );

        TempDetailDeliveryOrder::create($productData);

        return redirect('/deliveryorders/new');
    }

    public function getDetail()
    {
        $detailData = TempDetailDeliveryOrder::select('product_id', 'qty', 'note')->where([
            'product_id' => request('prod_id'),
            'temp_do_id' => session('temp_do_id')
        ])->first();

        return response([
            'status' => 'success',
            'detailData' => $detailData
        ]);
    }

    public function updateDetail()
    {
        $detailData = [
            'qty' => request('qty'),
            'note' => request('note')
        ];

        TempDetailDeliveryOrder::where([
            'product_id' => request('prod-id'),
            'temp_do_id' => session('temp_do_id')
        ])->update($detailData);

        return redirect()->back();
    }

    public function destroyDetail($prod_id)
    {
        TempDetailDeliveryOrder::where([
            'product_id' => $prod_id,
            'temp_do_id' => session('temp_do_id')
        ])->delete();

        return redirect()->back();
    }
}
