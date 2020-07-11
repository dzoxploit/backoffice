<?php

namespace App\Http\Controllers\Sales;

use App\Bargain;
use App\BargainDetail;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Lib\DMlib;
use App\PurchaseOrderCustomer;
use App\TempBargain;
use App\TempBargainDetail;
use App\TempDetailPurchaseOrderCustomer;
use App\TempPurchaseOrderCustomer;
use Carbon\Carbon;

class BargainCustomerController extends Controller
{
    public function index()
    {
        $bargains = Bargain::join('users', 'bargains.created_by', '=', 'users.id_user')->join('customers', 'bargains.customer_id', '=', 'customers.customer_id')->select('bargain_id', 'customers.fullname as customer_fullname', 'users.fullname as created_by', 'discount', 'discount_type', 'bargain_expr')->get();

        return view('sales.bargain.bargains', [
            'pageTitle' => 'Penawaran',
            'bargains' => $bargains
        ]);
    }

    public function create()
    {
        if (session()->has('temp_bargain_id')) {
            $getTempDetailBargain = TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id'))->get();
            $getTempBargain = TempBargain::where('temp_bargain_id', session('temp_bargain_id'))->first();
        } else {
            $getTempBargain = [];
            $getTempDetailBargain = [];
        }

        $customers = Customer::all();  

        return view('sales.bargain.create', [
            'pageTitle' => 'Penawaran',
            'tempBargain' => $getTempBargain,
            'tempDetailBargain' => $getTempDetailBargain,
            'customers' => $customers
        ]);
    }

    public function tempStore()
    {
        $tempBargainData = [
            'bargain_id' => request('bargain_id'), 
            'customer_id' => request('customer_id'), 
            'discount' => request('discount'), 
            'discount_type'=> request('discount_type'), 
            'bargain_expr' => request('bargain_expr'), 
            'bargain_note' => request('bargain_note'), 
            'temp_expr' => Carbon::now()->addDays(1)
        ]; 

        if (session()->has('temp_bargain_id')) {
            
            $tempBargain = TempBargain::where('temp_bargain_id', session('temp_bargain_id'))->update($tempBargainData);

            return response([
                'status' => 'not_insert'
            ]);
        } else {
            $tempBargain = TempBargain::create($tempBargainData);

            session(['temp_bargain_id' => $tempBargain->temp_bargain_id]); 

            return response([
                'status' => 'success',
            ], 200);
        }
    }

    public function showProduct(DMlib $dmlib)
    {
        if (request('q')) {
            $product = $dmlib->getProductByName(request('q'));
        } else {
            $product = array();
        }
   
        return view('sales.bargain.product', [
            'pageTitle' => 'Add Product',
            'product' => $product
        ]);
    }

    public function storeTempDetail(Dmlib $dmlib, $prod_id)
    {
        $getProduct = $dmlib->getProductById($prod_id);

        $tempBargainDetail = TempBargainDetail::where([
            'product_id' => $prod_id,
            'temp_bargain_id' => session('temp_Bargain_id')
        ])->count();

        $bargainDetailData = array(
            'product_id' => $getProduct->prod_id,
            'product_name' => $getProduct->prod_name,
            'qty' => 1,
            'unit_price' => $getProduct->prod_price,
            'bargain_price' => 0,
            'temp_bargain_id' => session('temp_bargain_id')
        );

        if ($tempBargainDetail > 0) {
            TempBargainDetail::where([
                'product_id' => $prod_id,
                'temp_bargain_id' => session('temp_bargain_id')
            ])->increment('qty');
        } else {
            TempBargainDetail::create($bargainDetailData);
        }

        return redirect('/sales/bargains/new');
    }

    public function getTempDetail($product_id)
    {
        $tempBargainDetail = TempBargainDetail::select('product_id', 'qty', 'unit_price', 'bargain_price')->where([
            'product_id' => $product_id, 
            'temp_bargain_id' => session('temp_bargain_id')
        ])->first();

        return response([
            'message' => 'detail_bargain_obtained',
            'detailData' => $tempBargainDetail,
        ]);
    }

    public function updateTempDetail()
    {
        $tempDetailData = [
            'qty' => request('qty'),
            'bargain_price' => request('bargain-price')
        ];

        TempBargainDetail::where([
            'product_id' => request('prod_id'),
            'temp_bargain_id' => session('temp_bargain_id')
        ])->update($tempDetailData);

        return redirect()->back();
    }

    public function destroyProductTempDetail($product_id)
    {
        TempBargainDetail::where([
            'product_id' => $product_id,
            'temp_bargain_id' => session('temp_bargain_id')
        ])->delete();

        return redirect()->back();
    }

    public function resetTempBargain()
    {
        TempBargain::where('temp_bargain_id', session('temp_bargain_id'))->delete();
        TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id'))->delete();

        session()->forget('temp_bargain_id');

        return redirect()->back();
    }

    public function store()
    {
        $bargainData = [
            'bargain_id' => request('bargain_id'), 
            'customer_id' => request('customer_id'), 
            'created_by' => session('id_user'), 
            'updated_by'=> session('id_user'), 
            'discount' => request('discount'), 
            'discount_type' => request('type'), 
            'bargain_expr' => request('bargain_expr'), 
            'bargain_note' => request('bargain_note'), 
            'bargain_closed' => null,
        ];

        $bargain = Bargain::create($bargainData);

        $tempBargainDetail = TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id'))->get();

        foreach ($tempBargainDetail as $tdbd) {
            $tempDetailData = [
                'product_id' => $tdbd->product_id,
                'product_name' => $tdbd->product_name,
                'qty' => $tdbd->qty,
                'unit_price' => $tdbd->unit_price,
                'bargain_price' => $tdbd->bargain_price,
                'bargain_id' => $bargain->bargain_id
            ];

            BargainDetail::create($tempDetailData);
        }

                
        TempBargain::where('temp_bargain_id', session('temp_bargain_id'))->delete();
        TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id'))->delete();

        session()->forget('temp_bargain_id');

        return redirect('/sales/bargains')->with('success', 'Bargains Berhasil di buat');        
    }

    public function destroy($bargain_id)
    {
        Bargain::where('bargain_id', $bargain_id)->delete();

        return redirect('/sales/bargains/');
    }

    public function calculateSubTotal($temp_bargain_id)
    {
        $tempDetail = TempBargainDetail::where([
            'temp_bargain_id' => $temp_bargain_id,
        ])->select('qty', 'unit_price', 'bargain_price')->get();

        $itemsPrice = array();
        foreach ($tempDetail as $tDetail) {
            if ($tDetail->bargain_price == 0) {
                $hargaDetail = $tDetail->unit_price * $tDetail->qty;
                $itemsPrice[] = intval($hargaDetail);
            }else {
                $itemsPrice[] = $tDetail->bargain_price;
            }
        }
        return array_sum($itemsPrice);
    }

    public function getCalcData()
    {
        return response([
            'subTotalPrice' => "Rp. " . number_format($this->calculateSubTotal(session('temp_bargain_id')), 2, ',', '.')
        ]);
    }

    public function getCalcDiscountData()
    {
        if (request('discount_type') == '$') {
            $subTotal = $this->calculateSubTotal(session('temp_bargain_id'));
            $discount = $subTotal - intval(request('discount'));

            return response([
                'totalPrice' => "Rp. " . number_format($discount, 2, ',', '.')
            ]);
        } else if (request('discount_type') == '%') {
            $subTotal = $this->calculateSubTotal(session('temp_bargain_id'));
            $discount = $subTotal * intval(request('discount')) / 100;

            return response([
                'totalPrice' => "Rp. " . number_format($subTotal - $discount, 2, ',', '.')
            ]);
        }
    }

    public function detail($bargain_id)
    {
        $getBargain = Bargain::where('bargain_id', $bargain_id)->first();

        $getDetailBargain = BargainDetail::where('bargain_id', $bargain_id)->get();
        
        return view('sales.bargain.detail', [
            'pageTitle' => 'Detail Bargain',
            'detailBargain' => $getDetailBargain,
            'bargain' => $getBargain
        ]);
    }
}
