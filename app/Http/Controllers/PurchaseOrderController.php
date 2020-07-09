<?php

namespace App\Http\Controllers;

use App\DetailPurchaseOrder;
use App\Lib\DMlib;
use App\PurchaseOrder;
use App\Supplier;
use App\TempDetailPurchaseOrder;
use App\TempPurchaseOrder;
use App\User;
use Carbon\Carbon;
use Exception;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrder = PurchaseOrder::join('suppliers', 'purchase_orders.sup_id', '=', 'suppliers.sup_id')
        ->select('purchase_orders.po_id', 'suppliers.sup_name', 'purchase_orders.discount', 'purchase_orders.type', 'purchase_orders.date')->get();

        return view('purchaseorder.purchase-order', [
            'pageTitle' => 'Purchase Order',
            'purchaseOrder' => $purchaseOrder
        ]);
    }

    public function create()
    {
        if (session()->has('temp_po_id')) {
            $getTempDetailPo = TempDetailPurchaseOrder::where('temp_po_id', session('temp_po_id'))->get();
            $getTempPo = TempPurchaseOrder::where('temp_po_id', session('temp_po_id'))->first();
        } else {
            $getTempPo = [];
            $getTempDetailPo = [];
        }

        $suppliers = Supplier::all();

        return view('purchaseorder.create', [
            'pageTitle' => 'New Purchase Order',
            'tempPo' => $getTempPo,
            'tempDetailPo' => $getTempDetailPo,
            'suppliers' => $suppliers
        ]);
    }



    public function store()
    {
        $purchaseOrders = [
            'po_id' => request('po_id'),
            'sup_id' => request('sup_id'),
            'discount' => request('discount'),
            'type' => request('type'),
            'date' => request('date'),
            'note' => request('note'),
            'id_user' => session('id_user')
        ];

        $purchaseOrder = PurchaseOrder::create($purchaseOrders);

        $tempDetailPo = TempDetailPurchaseOrder::where('temp_po_id', session('temp_po_id'))->get();

        foreach ($tempDetailPo as $tdpo) {
            $tempDetailData = [
                'product_id' => $tdpo->product_id,
                'product_name' => $tdpo->product_name,
                'qty' => $tdpo->qty,
                'price' => $tdpo->price,
                'discount' => $tdpo->discount,
                'po_id' => $purchaseOrder->po_id
            ];

            DetailPurchaseOrder::create($tempDetailData);
        }

        TempPurchaseOrder::where('temp_po_id', session('temp_po_id'))->delete();
        TempDetailPurchaseOrder::where('temp_po_id', session('temp_po_id'))->delete();

        session()->forget('temp_po_id');

        return redirect('/purchaseorders')->with('success', 'Purchase Order Berhasil di buat');
    }

    public function detail($po_id)
    {
        $getPo = PurchaseOrder::join('suppliers', 'purchase_orders.sup_id', '=', 'suppliers.sup_id')
        ->select('purchase_orders.po_id', 'suppliers.sup_name', 'purchase_orders.discount', 'purchase_orders.type', 'purchase_orders.date', 'purchase_orders.note')->where('po_id', $po_id)->first();

        $getDetailPo = DetailPurchaseOrder::where('po_id', $po_id)->select('product_id', 'product_name', 'qty', 'price', 'discount')->get();
    
        return view('purchaseorder.detail', [
            'pageTitle' => 'Detail Purchase Order',
            'detailPo' => $getDetailPo,
            'po' => $getPo
        ]);
    }

    public function destroy($po_id)
    {
        try {
            PurchaseOrder::where('po_id', $po_id)->delete();

            return redirect('/purchaseorders')->with('Success', 'PO berhasil di hapus');
        } catch (Exception $th) {
            return redirect('/purchaseorders')->with('Error', 'Hapus gagal, Tidak dapat terhubung ke database');
        }
    }


    public function tempStore()
    {
        $tempPoData = [
            'po_id' => request('po_num'),
            'sup_id' => request('supplier'),
            'discount' => request('discount'),
            'type' => request('type'),
            'date' => request('date'),
            'note' => request('note', ''),
            'id_user' => session('id_user'),
            'expr' => Carbon::now()->addDays(1)
        ];

        if (session()->has('temp_po_id')) {
            return response([
                'status' => 'not_insert'
            ]);
        } else {
            try {
                $tempPo = TempPurchaseOrder::create($tempPoData);

                session(['temp_po_id' => $tempPo->temp_po_id]); 

                return response([
                    'status' => 'success',
                ], 200);
            } catch (\Exception $th) {
                // throw $th;
                return response([
                    'status' => 'failed'
                ]);
            }
        }
    }

    public function showProduct(DMlib $dmlib)
    {
        if (request('q')) {
            $product = $dmlib->getProductByName(request('q'));
        } else {
            $product = array();
        }
   
        return view('purchaseorder.product', [
            'pageTitle' => 'Add Product',
            'product' => $product
        ]);
    }

    public function storeTempDetail(Dmlib $dmlib, $prod_id)
    {
        $getProduct = $dmlib->getProductById($prod_id);

        $tempDetailPo = TempDetailPurchaseOrder::where([
            'product_id' => $prod_id,
            'temp_po_id' => session('temp_po_id')
        ])->count();

        $productData = array(
            'product_id' => $getProduct->prod_id,
            'product_name' => $getProduct->prod_name,
            'qty' => 1,
            'price' => $getProduct->prod_price,
            'discount' => 0,
            'temp_po_id' => session('temp_po_id')
        );

        if ($tempDetailPo > 0) {
            TempDetailPurchaseOrder::where([
                'product_id' => $prod_id,
                'temp_po_id' => session('temp_po_id')
            ])->increment('qty');
        } else {
            TempDetailPurchaseOrder::create($productData);
        }

        return redirect('/purchaseorders/new');
    }

    public function getTempDetail($prod_id)
    {
        $tempDetailPo = TempDetailPurchaseOrder::select('product_id', 'qty', 'discount')->where('product_id', $prod_id)->first();

        return response([
            'message' => 'detailpo_obtained',
            'tempDetailPo' => $tempDetailPo,
        ]);
    }

    public function updateTempDetail()
    {
        $tempDetailData = [
            'qty' => request('qty'),
            'discount' => request('discount', 0)
        ];

        TempDetailPurchaseOrder::where([
            'product_id' => request('prod_id'),
            'temp_po_id' => session('temp_po_id')
        ])->update($tempDetailData);

        return redirect()->back();
    }

    public function resetTempPo()
    {
        TempPurchaseOrder::where('temp_po_id', session('temp_po_id'))->delete();
        TempDetailPurchaseOrder::where('temp_po_id', session('temp_po_id'))->delete();

        session()->forget('temp_po_id');

        return redirect()->back();
    }

    public function destroyProduct($prod_id)
    {
        TempDetailPurchaseOrder::where([
            'product_id' => $prod_id,
            'temp_po_id' => session('temp_po_id')
        ])->delete();

        return redirect()->back();
    }
}
