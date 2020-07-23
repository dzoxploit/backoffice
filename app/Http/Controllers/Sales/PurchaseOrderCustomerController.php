<?php

namespace App\Http\Controllers\Sales;

use App\Bargain;
use App\BargainDetail;
use App\Customer;
use App\DetailPurchaseOrderCustomer;
use App\Http\Controllers\Controller;
use App\Lib\DMlib;
use App\PurchaseOrderCustomer;
use App\TempDetailPurchaseOrderCustomer;
use App\TempPurchaseOrderCustomer;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;

class PurchaseOrderCustomerController extends Controller
{
    public function index()
    {
        $purchaseOrderCustomers = PurchaseOrderCustomer::join('customers', 'purchase_order_customers.customer_id', '=', 'customers.customer_id')->select('po_id', 'po_num', 'bargain_id', 'customers.fullname', 'po_discount', 'po_discount_type', 'purchase_order_customers.created_at', 'po_id_format')->orderBy('purchase_order_customers.created_at', 'DESC')->get();

        return view('sales.purchase-order.purchase-orders', [
            'pageTitle' => 'Purchase Order',
            'purchaseOrderCustomers' => $purchaseOrderCustomers,
            'tempPurchaseOrder'
        ]);
    }

    public function create()
    {
        if (session()->has('temp_po_customer_session')) {
            $tempSession = session('temp_po_customer_session');
            $getTempDetailPo = TempDetailPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->get();
            $getTempPo = TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->first();
            $getId = explode('/',$getTempPo->po_id);
            $arrangeId = [
                'romawi' => $getId[3],
                'year' => $getId[4]
            ];
        } else {
            $getTempPo = [];
            $getTempDetailPo = [];
            $arrangeId = [];
        }

        $customers = Customer::all();

        return view('sales.purchase-order.create', [
            'pageTitle' => 'New Purchase Order',
            'tempPo' => $getTempPo,
            'tempDetailPo' => $getTempDetailPo,
            'customers' => $customers,
            'arrangeId' => $arrangeId
        ]);
    }

    public function tempStore()
    {
        $po_id = '/PO/DM/'.request('po_id_romawi').'/'.request('po_id_year');

        $tempPoCustomerData = [
            'po_id' => $po_id,
            'po_num' => request('po_num'),
            'bargain_id' => request('bargain_id'),
            'customer_id' => request('customer_id'),
            'po_note' => request('po_note'),
            'po_discount' => request('po_discount'),
            'po_discount_type' => request('po_discount_type'),
            'id_user' => session('id_user'),
            'expr' => Carbon::now()->addDays(1)
        ];

        if (session()->has('temp_po_customer_session')) {
            $tempSession = session('temp_po_customer_session');
            TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->update($tempPoCustomerData);

            return response([
                'status' => 'not_insert'
            ]);
        } else {
            $tempPoCustomer = TempPurchaseOrderCustomer::create($tempPoCustomerData);
            
            session()->put('temp_po_customer_session',[
                'temp_po_customer_id' => $tempPoCustomer->temp_po_id,
                'temp_po_customer_bargain_id' => $tempPoCustomer->bargain_id
            ]);

            return response([
                'status' => 'success',
            ], 200);
        }
    }

    public function storeTempDetail(Dmlib $dmlib, $prod_id)
    {
        $getProduct = $dmlib->getProductById($prod_id);
        $tempSession = session('temp_po_customer_session');

        $tempDetailPo = TempDetailPurchaseOrderCustomer::where([
            'product_id' => $prod_id,
            'temp_po_id' => $tempSession['temp_po_customer_id']
        ])->count();

        $productData = array(
            'product_id' => $getProduct->prod_id,
            'product_name' => $getProduct->prod_name,
            'qty' => 1,
            'unit_price' => $getProduct->prod_price,
            'temp_po_id' => $tempSession['temp_po_customer_id']
        );

        if ($tempDetailPo > 0) {
            TempDetailPurchaseOrderCustomer::where([
                'product_id' => $prod_id,
                'temp_po_id' => $tempSession['temp_po_customer_id']
            ])->increment('qty');
        } else {
            TempDetailPurchaseOrderCustomer::create($productData);
        }

        return response([
            'status' => 'ok',
        ]);
    }

    public function getTempDetail($product_id)
    {
        $tempDetailPo = TempDetailPurchaseOrderCustomer::select('product_id', 'qty', 'unit_price')->where('product_id', $product_id)->first();

        return response([
            'message' => 'detailpo_obtained',
            'detailData' => $tempDetailPo,
        ]);
    }

    public function resetTempPo()
    {
        $tempSession = session('temp_po_customer_session');
        TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();
        TempDetailPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();

        session()->forget('temp_po_customer_session');

        return redirect()->back();
    }

    public function destroyProductTempDetail($product_id)
    {
        $tempSession = session('temp_po_customer_session');
        TempDetailPurchaseOrderCustomer::where([
            'product_id' => $product_id,
            'temp_po_id' => $tempSession['temp_po_customer_id']
        ])->delete();

        return redirect()->back();
    }

    public function updateTempDetail()
    {
        $tempSession = session('temp_po_customer_session');
        $tempDetailData = [
            'qty' => request('qty'),
            'unit_price' => request('unit_price')
        ];

        TempDetailPurchaseOrderCustomer::where([
            'product_id' => request('prod_id'),
            'temp_po_id' => $tempSession['temp_po_customer_id']
        ])->update($tempDetailData);

        return redirect()->back();
    }

    public function store()
    {
        $po_id_format = '/PO/DM/'.request('inputSalesPoPoIdCreateRomawi').'/'.request('inputSalesPoPoIdCreateYear');

        $attachment = request()->file('salesPoCustomerAttachment');
        $path = $attachment->store('attachment', 'public');

        $tempSession = session('temp_po_customer_session');
        $purchaseOrderCustomer = [
            'po_id_format' => $po_id_format,
            'po_num' => request('inputSalesPoPoNumCreate'),
            'bargain_id' => request('inputSalesPoBargainIdCreate'),
            'customer_id' => request('inputSalesPoCustomerIdCreate'),
            'po_note' => request('inputSalesPoNoteCreate'),
            'po_discount' => request('salesPurchaseOrderDiscount'),
            'po_discount_type' => request('salesPurchaseOrderDiscountType'),
            'po_attachment' => $path,
            'id_user' => session('id_user')
        ];

        $purchaseOrderCustomer = PurchaseOrderCustomer::create($purchaseOrderCustomer);

        $tempDetailPoCustomer = TempDetailPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->get();

        foreach ($tempDetailPoCustomer as $tdpoc) {
            $tempDetailData = [
                'product_id' => $tdpoc->product_id,
                'product_name' => $tdpoc->product_name,
                'qty' => $tdpoc->qty,
                'unit_price' => $tdpoc->unit_price,
                'po_id' => $purchaseOrderCustomer->po_id
            ];

            DetailPurchaseOrderCustomer::create($tempDetailData);
        }

        TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();
        TempDetailPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();

        session()->forget('temp_po_customer_session');

        return redirect('/sales/purchaseorders')->with('success', 'Purchase Order Berhasil di buat');
    }

    public function destroy($po_id)
    {
        PurchaseOrderCustomer::where('po_id', $po_id)->delete();

        return redirect('/sales/purchaseorders/');
    }

    public function detail($po_id)
    {
        $getPo = PurchaseOrderCustomer::join('customers', 'purchase_order_customers.customer_id', '=', 'customers.customer_id')->select('po_id', 'po_num', 'bargain_id', 'customers.fullname as customer_name', 'po_discount', 'po_discount_type', 'purchase_order_customers.created_at', 'po_id_format', 'po_note', 'po_attachment')->where('po_id', $po_id)->first();

        $getDetailPo = DetailPurchaseOrderCustomer::where('po_id', $po_id)->select('product_id', 'product_name', 'qty', 'unit_price')->get();

        return view('sales.purchase-order.detail', [
            'pageTitle' => 'Detail Purchase Order',
            'detailPo' => $getDetailPo,
            'po' => $getPo,
            'subTotal' => $this->calculateSubTotal($po_id, null)
        ]);
    }

    public function calculateSubTotal($po_id = null, $temp_po_id = null)
    {
        if ($po_id != null) {
            $detail = DetailPurchaseOrderCustomer::where([
                'po_id' => $po_id,
            ])->select('qty', 'unit_price')->get();

            $itemsPrice = array();
            foreach ($detail as $dtl) {
                $hargaDetail = $dtl->unit_price * $dtl->qty;
                $itemsPrice[] = intval($hargaDetail);
            }
            return array_sum($itemsPrice);
        } else if ($temp_po_id != null) {
            $tempDetail = TempDetailPurchaseOrderCustomer::where([
                'temp_po_id' => $temp_po_id,
            ])->select('qty', 'unit_price')->get();

            $itemsPrice = array();
            foreach ($tempDetail as $tDetail) {
                $hargaDetail = $tDetail->unit_price * $tDetail->qty;
                $itemsPrice[] = intval($hargaDetail);
            }
            return array_sum($itemsPrice);
        }
        else {
            return false;
        }
    }

    public function getCalcData()
    {
        $tempSession = session('temp_po_customer_session');
        return response([
            'subTotalPrice' => "Rp. " . number_format($this->calculateSubTotal(null, $tempSession['temp_po_customer_id']), 2, ',', '.')
        ]);
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
            $renderRow .= '<button type="button" class="btn btn-primary salesPoProductItemChoose" prod-id="' . $prod->prod_id . '">';
            $renderRow .= 'Choose';
            $renderRow .= '</button>';
            $renderRow .= '</td>';

            $productItem[] = $renderRow;
        }

        return $productItem;
    } 

    public function justCheckBargainId()
    {
        $bargain = Bargain::where('bargain_id', request('bargain_id'))->count();

        if ($bargain > 0) {
            return response([
                'status' => 'ok',
                'message' => 'Valid'
            ]);
        }else {
            return response([
                'status' => 'ok',
                'message' => 'Not Valid'
            ]);
        }
        
    }
    public function check()
    {
        $poIdExplode = explode("/",request('bargain_id'));
        
        $arrangePoIdFormat = [
            $poIdExplode['1'],
            $poIdExplode['2'],
            $poIdExplode['3'],
            $poIdExplode['4'],
        ];

        //dapatkan bargain idnya
        $bargain_id = ltrim($poIdExplode['0'], '0');
        $bargain_id_format = '/'.implode('/', $arrangePoIdFormat);
    
        //search bargain id yang sesuai dengan format
        $bargain = Bargain::where('bargain_id', $bargain_id)->where('bargain_id_format', $bargain_id_format)->count();
        if ($bargain > 0) {

            $po_id = '/ISD/DM/'.request('po_id_romawi').'/'.request('po_id_year');
            $tempPoCustomerData = [
                'po_id' => $po_id,
                'po_num' => request('po_num'),
                'bargain_id' => request('bargain_id'),
                'customer_id' => request('customer_id'),
                'po_note' => request('po_note'),
                'po_discount' => request('po_discount'),
                'po_discount_type' => request('po_discount_type'),
                'id_user' => session('id_user'),
                'expr' => Carbon::now()->addDays(1)
            ];

            if (session()->has('temp_po_customer_session')) {
                //kalo punya customer session
                $tempSession = session('temp_po_customer_session');
                if (request('bargain_id') == $tempSession['temp_po_customer_bargain_id']) {
                    //kalo sama request bargain_id sama yang ada di session
                    $po_id = '/PO/DM/'.request('po_id_romawi').'/'.request('po_id_year');
                    $tempPoCustomerDetailSameBargainId = [
                        'po_id' => $po_id,
                        'po_num' => request('po_num'),
                        'bargain_id' => $tempSession['temp_po_customer_bargain_id'],
                        'customer_id' => request('customer_id'),
                        'po_note' => request('po_note'),
                        'po_discount' => request('po_discount'),
                        'po_discount_type' => request('po_discount_type'),
                        'id_user' => session('id_user'),
                        'expr' => Carbon::now()->addDays(1)
                    ];

                    TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->update($tempPoCustomerDetailSameBargainId);
                }else {
                    //kalo gak sama request bargain_id sama yang ada di session

                    //update TempPurchaseOrderCustomer 
                    TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->update($tempPoCustomerData);

                    //delete detail sebelumnya
                    TempDetailPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();

                    //masukin detail baru
                    $bargainDetailIfNotSame = BargainDetail::where('bargain_id', $bargain_id)->get();
                    foreach ($bargainDetailIfNotSame as $bdins) {
                        $tempDetailIfNotSame = [
                            'product_id' => $bdins->product_id,
                            'product_name' => $bdins->product_name,
                            'qty' => $bdins->qty,
                            'unit_price' => $bdins->unit_price,
                            'temp_po_id' => $tempSession['temp_po_customer_id']
                        ];
                        TempDetailPurchaseOrderCustomer::create($tempDetailIfNotSame);
                    } 
                    
                    session()->put('temp_po_customer_session', [
                        'temp_po_customer_id' => $tempSession['temp_po_customer_id'],
                        'temp_po_customer_bargain_id' => $bargain_id
                    ]);
                }
            } else {
                //kalo nggk punya customer session
                $tempPoCustomer = TempPurchaseOrderCustomer::create($tempPoCustomerData);

                $bargainDetail = BargainDetail::where('bargain_id', $bargain_id)->get();
                foreach ($bargainDetail as $bd) {
                    $tempDetail = [
                        'product_id' => $bd->product_id,
                        'product_name' => $bd->product_name,
                        'qty' => $bd->qty,
                        'unit_price' => $bd->unit_price,
                        'temp_po_id' => $tempPoCustomer->temp_po_id
                    ];
                    TempDetailPurchaseOrderCustomer::create($tempDetail);
                } 

                session()->put('temp_po_customer_session', [
                    'temp_po_customer_id' => $tempPoCustomer->temp_po_id,
                    'temp_po_customer_bargain_id' => $tempPoCustomer->bargain_id
                ]);
            }

            return response([
                'message' => 'Valid',
                'msg_status' => 'bargain_is_valid'
            ]);
        } else {

            if (session()->has('temp_po_customer_session')) {
                $tempSession = session('temp_po_customer_session');
                TempPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();
                TempDetailPurchaseOrderCustomer::where('temp_po_id', $tempSession['temp_po_customer_id'])->delete();

                session()->forget('temp_po_customer_session');

                return response([
                    'message' => 'Not Valid',
                    'msg_status' => 'bargain_not_valid_with_run_query'
                ]);
            }else {
                return response([
                    'message' => 'Not Valid',
                    'msg_status' => 'bargain_not_valid'
                ]);
            }
            
            
            
        }
    }

    public function getCalcDiscountData()
    {
        $tempSession = session('temp_po_customer_session');

        if (request('discount_type') == '$') {
            $subTotal = $this->calculateSubTotal(null, $tempSession['temp_po_customer_id']);
            $discount = $subTotal - intval(request('discount'));

            return response([
                'totalPrice' => "Rp. " . number_format($discount, 2, ',', '.')
            ]);
        } else if (request('discount_type') == '%') {
            $subTotal = $this->calculateSubTotal(null, $tempSession['temp_po_customer_id']);
            $discount = $subTotal * intval(request('discount')) / 100;

            return response([
                'totalPrice' => "Rp. " . number_format($subTotal - $discount, 2, ',', '.')
            ]);
        }else{
            $subTotal = $this->calculateSubTotal(null, $tempSession['temp_po_customer_id']);
            return response([
                'totalPrice' => "Rp. " . number_format($subTotal, 2, ',', '.')
            ]);
        }
    }

    public function printToPDF()
    {
        // $getBargain = Bargain::join('users', 'users.id_user', '=', 'bargains.created_by')->join('customers', 'customers.customer_id', '=', 'bargains.customer_id')->where('bargain_id', $bargain_id)->select('bargain_id', 'customers.fullname as customer', 'users.fullname as created_by', 'discount', 'discount_type', 'bargain_note', 'bargain_expr', 'updated_by')->first();

        // $getDetailBargain = BargainDetail::where('bargain_id', $bargain_id)->get();

        // $getUpdatedBy = User::select('fullname')->where('id_user', $getBargain->updated_by)->first();

        // $data = [
        //     'getUpdatedBy' => $getUpdatedBy,
        //     'detailBargain' => $getDetailBargain,
        //     'bargain' => $getBargain,
        //     'subTotal' => $this->calculateSubTotal($bargain_id, null)
        // ];
        
        // // return view('pdf.bargains', $data);
        
        // $pdf = PDF::loadView('pdf.bargains', $data);
        // return $pdf->stream('bargains.pdf');
    }
}
