<?php

namespace App\Http\Controllers;

use App\Authorization;
use App\DetailPurchaseOrder;
use App\Http\Requests\InsertPurchaseOrder;
use App\Http\Requests\UpdateTempDetailPO;
use App\Lib\DMlib;
use App\PurchaseOrder;
use App\Supplier;
use App\TempDetailPurchaseOrder;
use App\TempDetailPurchaseOrderCustomer;
use App\TempPurchaseOrder;
use App\User;
use Carbon\Carbon;
use Exception;
use Barryvdh\DomPDF\Facade as PDF;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrder = PurchaseOrder::join('suppliers', 'purchase_orders.sup_id', '=', 'suppliers.sup_id')
            ->select('purchase_orders.po_id', 'suppliers.sup_name', 'purchase_orders.discount', 'purchase_orders.type', 'purchase_orders.date', 'po_id_format')->orderBy('purchase_orders.created_at', 'DESC')->paginate(10);

        return view('purchaseorder.purchase-order', [
            'pageTitle' => 'Surat Pesanan Ke Vendor',
            'purchaseOrder' => $purchaseOrder
        ]);
    }

    public function create()
    {
        if (session()->has('temp_po_id')) {
            $getTempDetailPo = TempDetailPurchaseOrder::where('temp_po_id', session('temp_po_id'))->get();
            $getTempPo = TempPurchaseOrder::where('temp_po_id', session('temp_po_id'))->first();
            $getId = explode('/',$getTempPo->po_id_format);
            $arrangeId = [
                'romawi' => $getId[3],
                'year' => $getId[4]
            ];
        } else {
            $getTempPo = [];
            $getTempDetailPo = [];
            $arrangeId = [];
        }

        $suppliers = Supplier::all();
        $contactPerson = User::select('id_user', 'fullname')->get();
        $authorization = Authorization::get();

        return view('purchaseorder.create', [
            'pageTitle' => 'Surat Pesanan Baru',
            'tempPo' => $getTempPo,
            'tempDetailPo' => $getTempDetailPo,
            'suppliers' => $suppliers,
            'arrangeId' => $arrangeId,
            'contactPerson' => $contactPerson,
            'authorization' => $authorization,
            'arrangeId' => $arrangeId
        ]);
    }

    public function tempStore()
    {
        $purchaseIdFormat = '/PO/DM/'.request('po_id_romawi').'/'.request('po_id_year');

        $tempPoData = [
            'po_id_format' => $purchaseIdFormat,
            'sup_id' => request('supplier'),
            'discount' => request('discount'),
            'type' => request('type'),
            'ppn' => (request('ppn') == 'true') ? 10 : 0,
            'date' => request('po_date'),
            'note' => request('note', ''),
            'payment_term' => request('payment_term'),
            'contact_person' => request('contact_person'),
            'po_request' => request('request'),
            'delivery_date' => request('delivery_date'),
            'delivery_point' => request('delivery_point'),
            'po_maker' => request('po_maker'),
            'po_approver' => request('po_approver'),
            'id_user' => session('id_user'),
            'expr' => Carbon::now()->addDays(1)
        ];

        if (session()->has('temp_po_id')) {
            $tempPo = TempPurchaseOrder::where('temp_po_id', session('temp_po_id'))->update($tempPoData);

            return response([
                'status' => 'not_insert'
            ]);
        } else {
            $tempPo = TempPurchaseOrder::create($tempPoData);

            session(['temp_po_id' => $tempPo->temp_po_id]);

            return response([
                'status' => 'success',
            ], 200);
        }
    }

    public function store(InsertPurchaseOrder $request)
    {
        $purchaseIdFormat = 'PO/PPS-DM/'.request('purchase_po_id_romawi').'/'.request('purchase_po_id_year').'/';

        $purchaseOrders = [
            'po_id_format' => $purchaseIdFormat,
            'sup_id' => $request->input('purchase_supplier_id'),
            'discount' => $request->input('purchase_po_discount'),
            'type' => $request->input('purchase_po_discount_type'),
            'ppn' => ($request->input('ppn') == 'on') ? 10 : 0,
            'date' => $request->input('purchase_po_date'),
            'note' => $request->input('purchase_po_note'),
            'payment_term' => $request->input('purchase_syarat_pemabayaran'),
            'contact_person' => $request->input('purchase_contact_person'),
            'po_request' => $request->input('purchase_po_request'), 
            'delivery_date' => $request->input('purchase_po_delivery_date'), 
            'delivery_point' => $request->input('purchase_po_tempat_penyerahan'), 
            'po_maker' => $request->input('purchase_po_yang_membuat'), 
            'po_approver' => $request->input('purchase_po_yang_menyetujui'),
            'id_user' => session('id_user')
        ];

        $purchaseOrder = PurchaseOrder::create($purchaseOrders);

        $tempDetailPo = TempDetailPurchaseOrder::where('temp_po_id', session('temp_po_id'))->get();

        foreach ($tempDetailPo as $tdpo) {
            $tempDetailData = [
                'product_id' => $tdpo->product_id,
                'product_name' => $tdpo->product_name,
                'qty' => $tdpo->qty,
                'unit' => $tdpo->unit,
                'unit_price' => $tdpo->unit_price,
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
                                ->join('users', 'contact_person', '=', 'users.id_user')
                                ->select('purchase_orders.po_id', 
                                         'suppliers.sup_name',
                                         'suppliers.sup_email',
                                         'suppliers.sup_address',
                                         'purchase_orders.discount',
                                         'purchase_orders.type',
                                         'purchase_orders.date',
                                         'purchase_orders.note',
                                         'po_id_format',
                                         'purchase_orders.date',
                                         'payment_term',
                                         'contact_person',
                                         'po_request',
                                         'delivery_date',
                                         'delivery_point',
                                         'ppn',
                                         'users.fullname as contact_person',
                                         'po_maker',
                                         'po_approver')
                                ->where('po_id', $po_id)->first();

        $getDetailPo = DetailPurchaseOrder::where('po_id', $po_id)->select('product_id', 'product_name', 'qty', 'unit', 'unit_price', 'discount')->get();

        $getAuthority = Authorization::whereIn('authorization_id', [$getPo->po_maker, $getPo->po_approver])->select('authorization_name')->get();

        if ($getAuthority->count() > 0) {
            $authority = $getAuthority;
        }else {
            $authority = [];
        }
        return view('purchaseorder.detail', [
            'pageTitle' => 'Detail Purchase Order',
            'detailPo' => $getDetailPo,
            'po' => $getPo,
            'subTotal' => $this->calculateSubTotal($po_id, null),
            'authority' => $authority
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
            'unit_price' => 0,
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

        return response([
            'status' => 'ok',
        ]);
    }

    public function getTempDetail($prod_id)
    {
        $tempDetailPo = TempDetailPurchaseOrder::select('product_id', 'qty', 'unit_price', 'unit', 'discount')->where('product_id', $prod_id)->first();

        return response([
            'message' => 'detailpo_obtained',
            'tempDetailPo' => $tempDetailPo,
        ]);
    }

    public function updateTempDetail(UpdateTempDetailPO $request)
    {
        $tempDetailData = array(
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'unit_price' => $request->input('unit_price', 0),
            'discount' => $request->input('discount', 0),
        );
        
        TempDetailPurchaseOrder::where([
            'product_id' => $request->input('product_id'),
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

    public function calculateSubTotal($po_id = null, $temp_po_id =null)
    {
        if ($po_id) {
            $detail = DetailPurchaseOrder::where([
                'po_id' => $po_id,
            ])->select('qty', 'unit_price', 'discount')->get();
    
            $itemsPrice = array();
            foreach ($detail as $dtl) {
                $hargaDetail = $dtl->unit_price * $dtl->qty;
                $discount = ($dtl->discount / 100) * $hargaDetail;
                $total = $hargaDetail - $discount;
                $itemsPrice[] = intval($total);
            }
            return array_sum($itemsPrice);
        }else if ($temp_po_id) {
            $tempDetail = TempDetailPurchaseOrder::where([
                'temp_po_id' => $temp_po_id,
            ])->select('qty', 'unit_price', 'discount')->get();
    
            $itemsPrice = array();
            foreach ($tempDetail as $tDetail) {
                $hargaDetail = $tDetail->unit_price * $tDetail->qty;
                $discount = ($tDetail->discount / 100) * $hargaDetail;
                $total = $hargaDetail - $discount;
                $itemsPrice[] = intval($total);
            }
            return array_sum($itemsPrice);
        }else {
            return false;
        }
    }

    // public function getCalcData()
    // {
    //     return response([
    //         'subTotalPrice' => "Rp. " . number_format($this->calculateSubTotal(null, session('temp_po_id')), 2, ',', '.')
    //     ]); 
    // }

    // public function getCalcDiscountData()
    // {
    //     if (request('discount_type') == '$') {
    //         $subTotal = $this->calculateSubTotal(null, session('temp_po_id'));
    //         $discount = $subTotal - intval(request('discount'));

    //         return response([
    //             'totalPrice' => "Rp. " . number_format($discount, 2, ',', '.')
    //         ]);
    //     } else if (request('discount_type') == '%') {
    //         $subTotal = $this->calculateSubTotal(null, session('temp_po_id'));
    //         $discount = $subTotal * intval(request('discount')) / 100;

    //         return response([
    //             'totalPrice' => "Rp. " . number_format($subTotal - $discount, 2, ',', '.')
    //         ]);
    //     }else {
    //         $subTotal = $this->calculateSubTotal(null, session('temp_po_id'));
    //         return response([
    //             'totalPrice' => "Rp. " . number_format($subTotal, 2, ',', '.')
    //         ]);
    //     }
    // }

    public function calcPpn(bool $ppn = false, $subTotal)
    {
        if ($ppn) {
            $ppnValue = 10/100;
            $ppnCalc = $subTotal * $ppnValue;

            return $ppnCalc;
        } else {
            return 0;
        }
    }

    /**
     * Kalkulasi total
     */
    public function calcTotal()
    {
        $subTotal = $this->calculateSubTotal(null, session('temp_po_id'));
        $ppn = $this->calcPpn((request('ppn') == 'true') ? true : false, $subTotal);

        if (request('discount_type') == '$') {
            $discount = intval(request('discount'));
        }elseif (request('discount_type') == '%') {
            $discountPercentage = intval(request('discount', 0)) / 100;
            $discount = $subTotal * $discountPercentage;
        }else {
            $discount = 0;
        }
    
        $total = ($subTotal - $discount) + $ppn;

        return response([
            'subTotalPrice' => "Rp. " . number_format($subTotal, 2, ',', '.'),
            'discount' => "Rp. " . number_format($discount, 2, ',', '.'),
            'ppn' => "Rp. " . number_format($ppn, 2, ',', '.'),
            'poTotalPrice' => "Rp. " . number_format($total, 2, ',', '.')
        ]);
    }

    public function printToPDF($po_id)
    {
        $getPo = PurchaseOrder::join('suppliers', 'purchase_orders.sup_id', '=', 'suppliers.sup_id')
            ->select('purchase_orders.po_id', 'suppliers.sup_name', 'suppliers.sup_email', 'suppliers.sup_address', 'purchase_orders.discount', 'purchase_orders.type', 'purchase_orders.date', 'purchase_orders.note', 'po_id_format', 'purchase_orders.date')->where('po_id', $po_id)->first();

        $getDetailPo = DetailPurchaseOrder::where('po_id', $po_id)->select('product_id', 'product_name', 'qty', 'unit_price', 'discount')->get();

        $data  = [
            'po' => $getPo,
            'detailPo' => $getDetailPo,
            'subTotal' => $this->calculateSubTotal($po_id, null)
        ];
        $pdf = PDF::loadView('pdf.purchasePo', $data);


        return view('pdf.purchasePo', $data);
        
        // return $pdf->stream('purchase.pdf');
    }

    public function searchProduct(DMlib $dmlib)
    {
        $keywords = request('keywords');
        if ($keywords) {
            $product = $dmlib->getProductByName($keywords);
        } else {
            $product = array();
        }

        $productItem = array();
        foreach ($product as $prod) {
            $renderRow  = '<tr>';
            $renderRow .= '<td>' . $prod->prod_id . '</td>';
            $renderRow .= '<td>' . $prod->prod_name . '</td>';
            $renderRow .= '<td>' . "Rp " . number_format($prod->prod_price, 2, ',', '.') . '</td>';
            $renderRow .= '<td>';
            $renderRow .= '<button type="button" class="btn btn-primary poProductItemChoose" prod-id="' . $prod->prod_id . '">';
            $renderRow .= 'Choose';
            $renderRow .= '</button>';
            $renderRow .= '</td>';

            $productItem[] = $renderRow;
        }

        return $productItem;
    }
}
