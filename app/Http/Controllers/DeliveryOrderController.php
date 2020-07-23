<?php

namespace App\Http\Controllers;

use App\DeliveryOrder;
use App\DetailDeliveryOrder;
use App\DetailPurchaseOrder;
use App\Lib\DMlib;
use App\PurchaseOrder;
use App\TempDeliveryOrder;
use App\TempDetailDeliveryOrder;
use Exception;

class DeliveryOrderController extends Controller
{
    public function index($po = false)
    {
        if ($po) {
            $purchaseOrders = PurchaseOrder::join('suppliers', 'purchase_orders.sup_id', '=', 'suppliers.sup_id')
                ->select('purchase_orders.po_id', 'suppliers.sup_name', 'purchase_orders.discount', 'purchase_orders.type', 'purchase_orders.date', 'po_id_format')->orderBy('purchase_orders.created_at', 'DESC')->paginate();

            return view('deliveryorders.polist', [
                'pageTitle' => 'Po List ',
                'purchaseOrders' => $purchaseOrders
            ]);
        } else {
            $deliveryOrder = DeliveryOrder::paginate(10);

            return view('deliveryorders.delivery-order', [
                'pageTitle' => 'Delivery Orders',
                'deliveryOrder' => $deliveryOrder
            ]);
        }
    }

    public function poList()
    {
        return $this->index(true);
    }

    public function create()
    {
        $po_id = request('po_id');
        $purchaseOrders = PurchaseOrder::where('po_id', $po_id)->first();
        if (empty($purchaseOrders)) {
            session()->forget('temp_do_id');
            return redirect('/deliveryorders/po');
        } else {
            if (session()->has('temp_do_id')) {
                $getTempDetailDo = TempDetailDeliveryOrder::where('temp_do_id', session('temp_do_id'))->get();
                $getTempDo = TempDeliveryOrder::where('temp_do_id', session('temp_do_id'))->first();
            } else {
                $getTempDo = [];
                $getTempDetailDo = [];
            }

            return view('deliveryorders.create', [
                'pageTitle' => 'New Delivery Order',
                'getTemp' => $getTempDo,
                'tempDetailDo' => $getTempDetailDo,
                'po' => $purchaseOrders,
            ]);
        }
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

        session()->forget('temp_do_id');

        return redirect('/deliveryorders')->with('success', 'Deliver Order Berhasil di buat');
    }

    public function detail($delivery_id)
    {
        $getDetailDo = DetailDeliveryOrder::where('do_id', $delivery_id)->get();
        $getDo = DeliveryOrder::where('do_id', $delivery_id)->first();

        return view('deliveryorders.detail', [
            'pageTitle' => 'New Delivery Order',
            'detailDo' => $getDetailDo,
            'do' => $getDo
        ]);
    }

    public function check()
    {
        $purchaseOrder = PurchaseOrder::where('po_id', request('po_id'))->count();
        if ($purchaseOrder > 0) {
            return response([
                'message' => 'Valid',
                'msg_status' => 'po_is_valid'
            ]);
        } else {
            return response([
                'message' => 'Not Valid',
                'msg_status' => 'po_not_valid'
            ]);
        }
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
        $doIdFormat = '/DO/DM/' . request('do_romawi') . '/' . request('do_year');

        $tempDeliveryOrderData = [
            'do_id_format' => $doIdFormat,
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

    public function showProduct()
    {
        //ambil po id dari delivery order
        $getPoId = TempDeliveryOrder::select('po_id')->where('temp_do_id', session('temp_do_id'))->first();

        //ambil product dari detail po 
        $detailPo = DetailPurchaseOrder::where('po_id', $getPoId->po_id)->get();

        //ambil product dari temp do
        $tempDetailDo = TempDetailDeliveryOrder::where('temp_do_id', session('temp_do_id'))->get();

        //ubah format si detail ponya
        $poItem = [];
        foreach ($detailPo as $dpo) {
            $poItem[$dpo->product_id] = [
                'product_id' => $dpo->product_id,
                'product_name' => $dpo->product_name,
                'qty' => $dpo->qty,
            ];
        }

        //ubah format detail temp donya
        $tempDetailDoItem = [];
        foreach ($tempDetailDo as $tddi) {
            $tempDetailDoItem[$tddi->product_id] = [
                'product_id' => $tddi->product_id,
                'product_name' => $tddi->product_name,
                'qty' => $tddi->qty,
            ];
        }

        //pilihin yang beda
        $yangBeda = array_diff_key($poItem, $tempDetailDoItem);

        //masukin ke array yangBedaItem
        $yangBedaItem = [];
        foreach ($yangBeda as $yb => $value) {
            $yangBedaItem[] = [
                'product_id' => $value['product_id'],
                'product_name' => $value['product_name'],
                'qty' => $value['qty']
            ];
            unset($poItem[$yb]);
        }

        //yang sama kurangin qtynya
        $productItem = [];
        foreach ($poItem as $pi => $value) {
            $calcQty = $value['qty'] - $tempDetailDoItem[$pi]['qty'];
            //kalo setelah dikurang jadi 0 ilangin ajh
            if ($calcQty == 0) {
                $productItem = [];
            } else {
                $productItem[] = [
                    'product_id' => $value['product_id'],
                    'product_name' => $value['product_name'],
                    'qty' => $calcQty
                ];
            }
        }

        return view('deliveryorders.product', [
            'pageTitle' => 'Add Product',
            'product' => array_merge($productItem, $yangBedaItem),
        ]);
    }

    public function storeProduct($product_id)
    {
        $getPoId = TempDeliveryOrder::select('po_id')->where('temp_do_id', session('temp_do_id'))->first();
        $getProduct = DetailPurchaseOrder::where('product_id', $product_id)->where('po_id', $getPoId->po_id)->first();

        $tempDetailDo = TempDetailDeliveryOrder::where([
            'product_id' => $product_id,
            'temp_do_id' => session('temp_do_id')
        ])->count();
        $productData = array(
            'product_id' => $getProduct->product_id,
            'product_name' => $getProduct->product_name,
            'qty' => 1,
            'note' => null,
            'temp_do_id' => session('temp_do_id')
        );

        if ($tempDetailDo > 0) {
            TempDetailDeliveryOrder::where([
                'product_id' => $product_id,
                'temp_do_id' => session('temp_do_id')
            ])->increment('qty');
        } else {
            TempDetailDeliveryOrder::create($productData);
        }

        return redirect('/deliveryorders/new?po_id='.$getPoId->po_id);
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
