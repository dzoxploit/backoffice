<?php

namespace App\Http\Controllers\Sales;

use App\Customer;
use App\DetailPurchaseOrderCustomer;
use App\Http\Controllers\Controller;
use App\Lib\DMlib;
use App\PurchaseOrderCustomer;
use App\TempDetailPurchaseOrderCustomer;
use App\TempPurchaseOrderCustomer;
use Carbon\Carbon;

class PurchaseOrderCustomerController extends Controller
{
    public function index()
    {
        $purchaseOrderCustomers = PurchaseOrderCustomer::join('customers', 'purchase_order_customers.customer_id', '=', 'customers.customer_id')->select('po_id', 'po_num', 'id_penawaran', 'customers.fullname', 'po_discount', 'po_discount_type', 'purchase_order_customers.created_at')->get();

        return view('sales.purchase-order.purchase-orders', [
            'pageTitle' => 'Purchase Order',
            'purchaseOrderCustomers' => $purchaseOrderCustomers
        ]);
    }

    public function create()
    {
        if (session()->has('temp_po_customer_id')) {
            $getTempDetailPo = TempDetailPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->get();
            $getTempPo = TempPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->first();
        } else {
            $getTempPo = [];
            $getTempDetailPo = [];
        }

        $customers = Customer::all(); 

        return view('sales.purchase-order.create', [
            'pageTitle' => 'New Purchase Order',
            'tempPo' => $getTempPo,
            'tempDetailPo' => $getTempDetailPo,
            'customers' => $customers,
        ]);
    }

    public function tempStore()
    {
        $tempPoCustomer = [
            'po_id' => request('po_id'), 
            'po_num' => request('po_num'), 
            'id_penawaran' => request('id_penawaran'), 
            'customer_id'=> request('customer_id'), 
            'po_note' => request('po_note'), 
            'po_discount' => request('po_discount'), 
            'po_discount_type' => request('po_discount_type'), 
            'id_user' => session('id_user'),
            'expr' => Carbon::now()->addDays(1)
        ]; 
        
        if (session()->has('temp_po_customer_id')) {
            TempPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->update($tempPoCustomer);

            return response([
                'status' => 'not_insert'
            ]);
        } else {
            $tempPoCustomer = TempPurchaseOrderCustomer::create($tempPoCustomer);

            session(['temp_po_customer_id' => $tempPoCustomer->temp_po_id]); 

            return response([
                'status' => 'success',
            ], 200);
            
            return response([
                'status' => 'failed'
            ]);
        }
    }

    public function showProduct(DMlib $dmlib)
    {
        if (request('q')) {
            $product = $dmlib->getProductByName(request('q'));
        } else {
            $product = array();
        }
   
        return view('sales.purchase-order.product', [
            'pageTitle' => 'Add Product',
            'product' => $product
        ]);
    }

    public function storeTempDetail(Dmlib $dmlib, $prod_id)
    {
        $getProduct = $dmlib->getProductById($prod_id);

        $tempDetailPo = TempDetailPurchaseOrderCustomer::where([
            'product_id' => $prod_id,
            'temp_po_id' => session('temp_po_customer_id')
        ])->count();

        $productData = array(
            'product_id' => $getProduct->prod_id,
            'product_name' => $getProduct->prod_name,
            'qty' => 1,
            'price' => $getProduct->prod_price,
            'discount' => 0,
            'temp_po_id' => session('temp_po_customer_id')
        );

        if ($tempDetailPo > 0) {
            TempDetailPurchaseOrderCustomer::where([
                'product_id' => $prod_id,
                'temp_po_id' => session('temp_po_customer_id')
            ])->increment('qty');
        } else {
            TempDetailPurchaseOrderCustomer::create($productData);
        }

        return redirect('/sales/purchaseorders/new');
    }

    public function getTempDetail($product_id)
    {
        $tempDetailPo = TempDetailPurchaseOrderCustomer::select('product_id', 'qty', 'discount')->where('product_id', $product_id)->first();

        return response([
            'message' => 'detailpo_obtained',
            'detailData' => $tempDetailPo,
        ]);
    }

    public function resetTempPo()
    {
        TempPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->delete();
        TempDetailPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->delete();

        session()->forget('temp_po_customer_id');

        return redirect()->back();
    }

    public function destroyProductTempDetail($product_id)
    {
        TempDetailPurchaseOrderCustomer::where([
            'product_id' => $product_id,
            'temp_po_id' => session('temp_po_customer_id')
        ])->delete();

        return redirect()->back();
    }

    public function updateTempDetail()
    {
        $tempDetailData = [
            'qty' => request('qty'),
            'discount' => request('discount', 0)
        ];

        TempDetailPurchaseOrderCustomer::where([
            'product_id' => request('prod_id'),
            'temp_po_id' => session('temp_po_customer_id')
        ])->update($tempDetailData);

        return redirect()->back();
    }

    public function store()
    {
        $purchaseOrderCustomer = [
            'po_id' => request('purchase-order-po-id'), 
            'po_num' => request('purchase-order-po-num'), 
            'id_penawaran' => request('purchase-order-id-penawaran'), 
            'customer_id'=> request('purchase-order-customer-id'), 
            'po_note' => request('purchase-order-note'), 
            'po_discount' => request('purchase-order-discount'), 
            'po_discount_type' => request('purchase-order-type'), 
            'id_user' => session('id_user')
        ]; 

        $purchaseOrderCustomer = PurchaseOrderCustomer::create($purchaseOrderCustomer);

        $tempDetailPoCustomer = TempDetailPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->get();

        foreach ($tempDetailPoCustomer as $tdpoc) {
            $tempDetailData = [
                'product_id' => $tdpoc->product_id,
                'product_name' => $tdpoc->product_name,
                'qty' => $tdpoc->qty,
                'price' => $tdpoc->price,
                'discount' => $tdpoc->discount,
                'po_id' => $purchaseOrderCustomer->po_id
            ];

            DetailPurchaseOrderCustomer::create($tempDetailData);
        }

                

        TempPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->delete();
        TempDetailPurchaseOrderCustomer::where('temp_po_id', session('temp_po_customer_id'))->delete();

        session()->forget('temp_po_id');

        return redirect('/sales/purchaseorders')->with('success', 'Purchase Order Berhasil di buat');        
    }

    public function destroy($po_id)
    {
        PurchaseOrderCustomer::where('po_id', $po_id)->delete();

        return redirect('/sales/purchaseorders/');
    }

    public function detail($po_id)
    {
        $getPo = PurchaseOrderCustomer::where('po_id', $po_id)->first();

        $getDetailPo = DetailPurchaseOrderCustomer::where('po_id', $po_id)->select('product_id', 'product_name', 'qty', 'price', 'discount')->get();
    
        return view('sales.purchase-order.detail', [
            'pageTitle' => 'Detail Purchase Order',
            'detailPo' => $getDetailPo,
            'po' => $getPo,
            'subTotal' => $this->calculateSubTotal($po_id, null)
        ]);
    }

    public function calculateSubTotal($po_id = null, $temp_po_id =null)
    {
        if ($po_id) {
            $detail = DetailPurchaseOrderCustomer::where([
                'po_id' => $po_id,
            ])->select('qty', 'price', 'discount')->get();
    
            $itemsPrice = array();
            foreach ($detail as $dtl) {
                $hargaDetail = $dtl->price * $dtl->qty;
                $discount = ($dtl->discount / 100) * $hargaDetail;
                $total = $hargaDetail - $discount;
                $itemsPrice[] = intval($total);
            }
            return array_sum($itemsPrice);
        }else if ($temp_po_id) {
            $tempDetail = TempDetailPurchaseOrderCustomer::where([
                'temp_po_id' => $temp_po_id,
            ])->select('qty', 'price', 'discount')->get();
    
            $itemsPrice = array();
            foreach ($tempDetail as $tDetail) {
                $hargaDetail = $tDetail->price * $tDetail->qty;
                $discount = ($tDetail->discount / 100) * $hargaDetail;
                $total = $hargaDetail - $discount;
                $itemsPrice[] = intval($total);
            }
            return array_sum($itemsPrice);
        }else {
            return false;
        }
      
    }

}
