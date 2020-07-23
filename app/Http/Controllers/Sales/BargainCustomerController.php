<?php

namespace App\Http\Controllers\Sales;

use App\Bargain;
use App\BargainDetail;
use App\BargainHistory;
use App\BargainHistoryDetail;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Lib\DMlib;
use App\TempBargain;
use App\TempBargainDetail;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class BargainCustomerController extends Controller
{
    public function index()
    {
        $bargains = Bargain::join('users', 'bargains.created_by', '=', 'users.id_user')->join('customers', 'bargains.customer_id', '=', 'customers.customer_id')->select('bargain_id', 'customers.fullname as customer_fullname', 'users.fullname as created_by', 'discount', 'discount_type', 'bargain_expr', 'bargain_id_format')->orderBy('bargains.created_at', 'DESC')->get();

        return view('sales.bargain.bargains', [
            'pageTitle' => 'Quotation to Customer',
            'bargains' => $bargains,
        ]);
    }

    public function create()
    {
        if (session()->has('temp_bargain_id')) {
            $getTempDetailBargain = TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id'))->get();
            $getTempBargain = TempBargain::where('temp_bargain_id', session('temp_bargain_id'))->first();
            $getId = explode('/',$getTempBargain->bargain_id_format);
            $arrangeId = [
                'romawi' => $getId[3],
                'year' => $getId[4]
            ];
        } else {
            $getTempBargain = [];
            $getTempDetailBargain = [];
            $arrangeId = [];

        }

        $customers = Customer::all();

        return view('sales.bargain.create', [
            'pageTitle' => 'Penawaran',
            'tempBargain' => $getTempBargain,
            'tempDetailBargain' => $getTempDetailBargain,
            'customers' => $customers,
            'arrangeId' => $arrangeId
        ]);
    }

    public function tempStore()
    {
        $purchaseIdFormat = '/Penawaran/DM/'.request('bargain_id_romawi').'/'.request('bargain_id_year');

        $tempBargainData = [
            'bargain_id_format' => $purchaseIdFormat,
            'customer_id' => request('customer_id'),
            'created_by' => session('id_user'),
            'updated_by' => session('id_user'),
            'discount' => request('discount'),
            'discount_type' => request('discount_type'),
            'action' => 'save',
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

    /**
     * Update Temporary jika ada yang dirubah di halaman edit
     * 
     */
    public function tempUpdate()
    {
        $getActive = TempBargain::select('temp_bargain_id', 'status')->where([
            'bargain_id' => request('bargain_id'),
            'status' => 'active',
        ])->whereDate('temp_expr', '>', now()->toDateTime())->first();

        if ($getActive) {
            //jika aktif update temp_bargains
            $tempBargainData = [
                'updated_by' => session('id_user'),
                'discount' => request('discount'),
                'discount_type' => request('discount_type'),
                'bargain_note' => request('bargain_note')
            ];

            TempBargain::where('temp_bargain_id', $getActive->temp_bargain_id)->update($tempBargainData);
        } else {
            //jika tidak aktif, perpanjang temporary expr
            TempBargain::where('temp_bargain_id', $getActive->temp_bargain_id)->update('temp_expr', now()->addHour(1));
        }
    }

    public function show($bargain_id)
    {

        $getActive = TempBargain::select('status', 'temp_bargain_id')->where([
            'bargain_id' => $bargain_id,
            'status' => 'active',
        ])->whereDate('temp_expr', '>', now()->toDateTime())->first();

        if ($getActive) {
            session()->put('temp_bargain_id_edit', $getActive->temp_bargain_id);
        } else {
            //get data bargain
            $bargain = Bargain::where('bargain_id', $bargain_id)->first();
            // pindahin ke temp bargain
            $tempBargainData = [
                'bargain_id' => $bargain->bargain_id,
                'customer_id' => $bargain->customer_id,
                'created_by' => $bargain->created_by,
                'updated_by' => $bargain->updated_by,
                'discount' => $bargain->discount,
                'discount_type' => $bargain->discount_type,
                'action' => 'edit',
                'status' => 'active',
                'bargain_expr' => $bargain->bargain_expr,
                'bargain_note' => $bargain->bargain_note,
                'temp_expr' => now()->addDays(1)
            ];
            $tempBargain = TempBargain::create($tempBargainData);

            // get data dari detail bargain
            $detailBargain = BargainDetail::where('bargain_id', $bargain_id)->get();

            // pindahin ke temp detail bargain
            foreach ($detailBargain as $db) {
                $detailBargainData = [
                    'product_id' => $db->product_id,
                    'product_name' => $db->product_name,
                    'qty' => $db->qty,
                    'unit_price' => $db->unit_price,
                    'bargain_price' => $db->bargain_price,
                    'temp_bargain_id' => $tempBargain->temp_bargain_id,
                ];
                TempBargainDetail::create($detailBargainData);
            }

            // create session
            session()->put('temp_bargain_id_edit', $tempBargain->temp_bargain_id);
        }


        $getTempBargain = TempBargain::where('temp_bargain_id', session('temp_bargain_id_edit'))->join('customers', 'temp_bargains.customer_id', '=', 'customers.customer_id')->select('bargain_id', 'customers.fullname as customer_name', 'discount', 'discount_type', 'bargain_expr', 'bargain_note', 'updated_by', 'created_by')->first();

        $getTempDetailBargain = TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id_edit'))->get();

        $getCreatedBy = User::select('fullname as createdBy')->where('id_user', $getTempBargain->created_by)->first();

        $getLastUpdatedBy = User::select('fullname as lastUpdatedBy')->where('id_user', $getTempBargain->updated_by)->first();

        return view('sales.bargain.edit', [
            'pageTitle' => 'Ubah Penawaran',
            'getCreatedBy' => $getCreatedBy,
            'lastUpdatedBy' => $getLastUpdatedBy,
            'tempBargain' => $getTempBargain,
            'tempDetailBargain' => $getTempDetailBargain,
        ]);
    }

    public function storeEdit()
    {
        //getbargain
        $bargain = Bargain::select('bargain_id', 'customer_id', 'created_by', 'updated_by', 'discount', 'discount_type', 'bargain_expr', 'bargain_note', 'bargain_closed')->where('bargain_id', request('bargain_id'))->first()->toArray();

        //getbargaindetail
        $bargainDetail = BargainDetail::select('product_id', 'product_name', 'qty', 'unit_price', 'bargain_price', 'bargain_id')->where('bargain_id', request('bargain_id'))->get()->toArray();

        //storebargain to history
        BargainHistory::create($bargain);

        //storebargain detail to history detail
        foreach ($bargainDetail as $bD) {
            BargainHistoryDetail::create($bD);
        }

        //update bargain
        $bargainData = [
            'updated_by' => session('id_user'),
            'discount' => request('discount'),
            'discount_type' => request('discount_type'),
            'bargain_note' => request('bargain_note'),
        ];
        Bargain::where('bargain_id', request('bargain_id'))->update($bargainData);

        //get updated bargain 
        $updatedBargain = Bargain::where('bargain_id', request('bargain_id'))->first();

        //store updatedbargain to history
        $updatedBargainData = [
            'bargain_id' => $updatedBargain->bargain_id,
            'customer_id' => $updatedBargain->customer_id,
            'created_by' => $updatedBargain->created_by,
            'updated_by' => $updatedBargain->updated_by,
            'discount' => $updatedBargain->discount,
            'discount_type' => $updatedBargain->discount_type,
            'bargain_expr' => $updatedBargain->bargain_expr,
            'bargain_note' => $updatedBargain->bargain_note,
            'bargain_closed' => $updatedBargain->bargain_closed
        ];
        BargainHistory::create($updatedBargainData);
        // foreach ($variable as $key => $value) {
        //     BargainHistoryDetail::create($bargainDetail); 
        // }

        return response([
            'status' => 'success'
        ]);
    }

    public function showProductForSave(DMlib $dmlib)
    {
        if (request('query')) {
            $product = $dmlib->getProductByName(request('query'));
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
            $renderRow .= '<button type="button" class="btn btn-primary chooseProductIdSave" prod-id="' . $prod->prod_id . '">';
            $renderRow .= 'Choose';
            $renderRow .= '</button>';
            $renderRow .= '</td>';

            $productItem[] = $renderRow;
        }

        return $productItem;
    }

    public function showProductForEdit(DMlib $dmlib)
    {
        if (request('query')) {
            $product = $dmlib->getProductByName(request('query'));
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
            $renderRow .= '<button type="button" class="btn btn-primary chooseProductIdEdit" prod-id="' . $prod->prod_id . '">';
            $renderRow .= 'Choose';
            $renderRow .= '</button>';
            $renderRow .= '</td>';

            $productItem[] = $renderRow;
        }

        return $productItem;
    }

    public function showProduct(DMlib $dmlib)
    {
        if (request('query')) {
            $product = $dmlib->getProductByName(request('query'));
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
            $renderRow .= '<button type="button" id="bargainTest" class="btn btn-primary" prod-id="' . $prod->prod_id . '">';
            $renderRow .= 'Choose';
            $renderRow .= '</button>';
            $renderRow .= '</td>';

            $productItem[] = $renderRow;
        }

        return $productItem;
    }

    public function storeTempDetail(Dmlib $dmlib, $prod_id)
    {
        $getProduct = $dmlib->getProductById($prod_id);

        $tempBargainDetail = TempBargainDetail::where([
            'product_id' => $prod_id,
            'temp_bargain_id' => session('temp_bargain_id')
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

        return response([
            'status' => 'success'
        ]);
    }

    public function storeTempDetailEdit(Dmlib $dmlib, $prod_id)
    {
        //get product dari db duniamurah
        $getProduct = $dmlib->getProductById($prod_id);

        //check adakah product yang sama di temporary
        $tempBargainDetail = TempBargainDetail::where([
            'product_id' => $prod_id,
            'temp_bargain_id' => session('temp_bargain_id_edit')
        ])->count();

        if ($tempBargainDetail > 0) {
            //naikin qty kalo ada yang sama
            TempBargainDetail::where([
                'product_id' => $prod_id,
                'temp_bargain_id' => session('temp_bargain_id_edit')
            ])->increment('qty');
        } else {
            //masukin product baru jika tidak ada yang sama
            $bargainDetailData = array(
                'product_id' => $getProduct->prod_id,
                'product_name' => $getProduct->prod_name,
                'qty' => 1,
                'unit_price' => $getProduct->prod_price,
                'bargain_price' => 0,
                'temp_bargain_id' => session('temp_bargain_id_edit')
            );

            TempBargainDetail::create($bargainDetailData);
        }
        return response([
            'status' => 'success'
        ]);
    }

    public function getTempDetail($product_id)
    {
        if (request('actiontype') == 'edit') {
            $actionType = session('temp_bargain_id_edit');
        } else if (request('actiontype') == 'save') {
            $actionType = session('temp_bargain_id');
        }

        $tempBargainDetail = TempBargainDetail::select('product_id', 'qty', 'unit_price')->where([
            'product_id' => $product_id,
            'temp_bargain_id' => $actionType
        ])->first();

        return response([
            'message' => 'detail_bargain_obtained',
            'detailData' => $tempBargainDetail,
        ]);
    }

    public function updateTempDetail()
    {
        if (request('actiontype') == 'edit') {
            $actionType = session('temp_bargain_id_edit');
        } else if (request('actiontype') == 'save') {
            $actionType = session('temp_bargain_id');
        }

        $tempDetailData = [
            'qty' => request('qty'),
            'unit_price' => request('unit-price'),
        ];

        TempBargainDetail::where([
            'product_id' => request('prod_id'),
            'temp_bargain_id' => $actionType
        ])->update($tempDetailData);

        return redirect()->back();
    }

    public function destroyProductTempDetail($product_id)
    {
        if (request('actiontype') == 'edit') {
            $actionType = session('temp_bargain_id_edit');
        } else if (request('actiontype') == 'save') {
            $actionType = session('temp_bargain_id');
        }

        TempBargainDetail::where([
            'product_id' => $product_id,
            'temp_bargain_id' => $actionType
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

    public function defaultTempBargainEdit()
    {
        //get temp bargain data
        $tempBargain = TempBargain::where('temp_bargain_id', session('temp_bargain_id_edit'));
        $getTempBargainData = $tempBargain->select('temp_bargain_id', 'bargain_id')->first();

        //ambil bargain data berdarkan temp bargain data
        $getBargainData = Bargain::where('bargain_id', $getTempBargainData->bargain_id)->select('discount', 'discount_type', 'bargain_note')->first();

        //update ke tempBargainData
        $bargainData = [
            'discount' => $getBargainData->discount,
            'discount_type' => $getBargainData->discount_type,
            'bargain_note' => $getBargainData->bargain_note,
        ];
        TempBargain::where('bargain_id', $getTempBargainData->temp_bargain_id)->update($bargainData);

        //delete data yang ada di temp bargain detail
        TempBargainDetail::where('temp_bargain_id', $getTempBargainData->temp_bargain_id)->delete();

        //store data dari bargain detail ke temp bargain detail
        $bargainDetail = BargainDetail::select('product_id', 'product_name', 'qty', 'unit_price', 'bargain_price')->where('bargain_id', $getTempBargainData->bargain_id)->get();

        foreach ($bargainDetail as $bd) {
            $bargainDetailData = [
                'product_id' => $bd->product_id,
                'product_name' => $bd->product_name,
                'qty' => $bd->qty,
                'unit_price' => $bd->unit_price,
                'bargain_price' => $bd->bargain_price,
                'temp_bargain_id' => $getTempBargainData->temp_bargain_id
            ];

            TempBargainDetail::create($bargainDetailData);
        }

        return redirect()->back();
    }

    public function cancelTempBargainEdit($bargain_id)
    {
        TempBargain::where('temp_bargain_id', session('temp_bargain_id_edit'))->delete();
        TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id_edit'))->delete();
        session()->forget('temp_bargain_id_edit');

        return redirect('/sales/bargains');
    }

    public function store()
    {
        $bargainIdFormat = '/Penawaran/DM/'.request('bargain_id_romawi').'/'.request('bargain_id_year');

        //insert ke bargain
        $bargainData = [
            'bargain_id_format' => $bargainIdFormat,
            'customer_id' => request('customer_id'),
            'created_by' => session('id_user'),
            'updated_by' => session('id_user'),
            'discount' => request('discount'),
            'discount_type' => request('discount') == null ? null : request('type'),
            'bargain_expr' => request('bargain_expr'),
            'bargain_note' => request('bargain_note'),
            'bargain_closed' => null,
        ];

        $bargain = Bargain::create($bargainData);
        // //insert to history
        // $bargainHistory = BargainHistory::create($bargainData);

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

        // foreach ($tempBargainDetail as $tdbd) {
        //     $tempDetailData = [
        //         'product_id' => $tdbd->product_id,
        //         'product_name' => $tdbd->product_name,
        //         'qty' => $tdbd->qty,
        //         'unit_price' => $tdbd->unit_price,
        //         'bargain_price' => $tdbd->bargain_price,
        //         'history_bargain_id' => $bargainHistory->history_bargain_id
        //     ];
        //     BargainHistoryDetail::create($tempDetailData);
        // }

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

    public function calculateSubTotal($bargain_id = null, $temp_bargain_id = null)
    {
        if ($bargain_id) {
            $detail = BargainDetail::where([
                'bargain_id' => $bargain_id,
            ])->select('qty', 'unit_price', 'bargain_price')->get();

            $itemsPrice = array();
            foreach ($detail as $dt) {
                if ($dt->bargain_price == 0) {
                    $hargaDetail = $dt->unit_price * $dt->qty;
                    $itemsPrice[] = intval($hargaDetail);
                } else {
                    $itemsPrice[] = $dt->bargain_price;
                }
            }
            return array_sum($itemsPrice);
        } else if ($temp_bargain_id) {
            $tempDetail = TempBargainDetail::where([
                'temp_bargain_id' => $temp_bargain_id,
            ])->select('qty', 'unit_price', 'bargain_price')->get();

            $itemsPrice = array();
            foreach ($tempDetail as $tDetail) {
                if ($tDetail->bargain_price == 0) {
                    $hargaDetail = $tDetail->unit_price * $tDetail->qty;
                    $itemsPrice[] = intval($hargaDetail);
                } else {
                    $itemsPrice[] = $tDetail->bargain_price;
                }
            }
            return array_sum($itemsPrice);
        }
    }

    public function getCalcData()
    {
        if (request('calc') == 'edit') {
            $calc = $this->calculateSubTotal(null, session('temp_bargain_id_edit'));
        } else if (request('calc') == 'save') {
            $calc = $this->calculateSubTotal(null, session('temp_bargain_id'));
        }

        return response([
            'subTotalPrice' => "Rp. " . number_format($calc, 2, ',', '.')
        ]);
    }

    public function getCalcDiscountData()
    {
        if (request('calc') == 'edit') {
            $calc = session('temp_bargain_id_edit');
        } else if (request('calc') == 'save') {
            $calc = session('temp_bargain_id');
        }

        if (request('discount_type') == '$') {
            $subTotal = $this->calculateSubTotal(null, $calc);
            $discount = $subTotal - intval(request('discount'));

            return response([
                'totalPrice' => "Rp. " . number_format($discount, 2, ',', '.')
            ]);
        } else if (request('discount_type') == '%') {
            $subTotal = $this->calculateSubTotal(null, $calc);
            $discount = $subTotal * intval(request('discount')) / 100;

            return response([
                'totalPrice' => "Rp. " . number_format($subTotal - $discount, 2, ',', '.')
            ]);
        }
        else {
            $subTotal = $this->calculateSubTotal(null, $calc);
            return response([
                'totalPrice' => "Rp. " . number_format($subTotal, 2, ',', '.')
            ]);
        }
    }

    public function detail($bargain_id)
    {
        $getBargain = Bargain::join('users', 'users.id_user', '=', 'bargains.created_by')->join('customers', 'customers.customer_id', '=', 'bargains.customer_id')->where('bargain_id', $bargain_id)->select('bargain_id', 'customers.fullname as customer', 'users.fullname as created_by', 'discount', 'discount_type', 'bargain_note', 'bargain_expr', 'updated_by', 'bargain_id_format')->first();

        $getDetailBargain = BargainDetail::where('bargain_id', $bargain_id)->get();

        $getUpdatedBy = User::select('fullname')->where('id_user', $getBargain->updated_by)->first();

        return view('sales.bargain.detail', [
            'pageTitle' => 'Detail Quotation to Customer',
            'getUpdatedBy' => $getUpdatedBy,
            'detailBargain' => $getDetailBargain,
            'bargain' => $getBargain,
            'subTotal' => $this->calculateSubTotal($bargain_id, null)
        ]);
    }

    /**
     * Update data ke bargains
     * 
     */
    public function update()
    {
        //ambil data dari temp bargain
        $tempBargain = TempBargain::where('temp_bargain_id', session('temp_bargain_id_edit'))->first();

        //bargain instance
        $bargain = Bargain::where('bargain_id', $tempBargain->bargain_id);
        //get bargain
        // $getForHistory = $bargain->first();
        // //insert ke history
        // $historyBargainData = [
        //     'bargain_id' => $getForHistory->bargain_id,
        //     'customer_id' => $getForHistory->customer_id,
        //     'created_by' => $getForHistory->created_by,
        //     'updated_by' => $getForHistory->updated_by,
        //     'discount' => $getForHistory->discount,
        //     'discount_type' => $getForHistory->discount_type,
        //     'bargain_expr' => $getForHistory->bargain_expr,
        //     'bargain_note' => $getForHistory->bargain_note,
        //     'bargain_closed' => $getForHistory->bargain_closed,
        // ];
        // BargainHistory::create($historyBargainData);

        //update ke bargain
        $bargainData = [
            'customer_id' => $tempBargain->customer_id,
            'updated_by' => session('id_user'),
            'discount' => request('discount'),
            'discount_type' => request('discount_type'),
            'bargain_expr' => $tempBargain->bargain_expr,
            'bargain_note' => request('bargain_note'),
            'bargain_closed' => null
        ];
        $bargain->update($bargainData);

        //ambil data dari temp detail bargain 
        $tempDetailBargain = TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id_edit'))->get();
        //delete detail dulu
        BargainDetail::where('bargain_id', $tempBargain->bargain_id)->delete();
        //insert ke detail bargain
        foreach ($tempDetailBargain as $tdb) {
            $bargainDetailData = [
                'product_id' => $tdb->product_id,
                'product_name' => $tdb->product_name,
                'qty' => $tdb->qty,
                'unit_price' => $tdb->unit_price,
                'bargain_price' => $tdb->bargain_price,
                'bargain_id' => $tempBargain->bargain_id
            ];
            BargainDetail::create($bargainDetailData);
        }
        // foreach ($tempDetailBargain as $tdb) {
        //     $bargainDetailDataHistory = [
        //         'product_id' => $tdb->product_id,
        //         'product_name' => $tdb->product_name,
        //         'qty' => $tdb->qty,
        //         'unit_price' => $tdb->unit_price,
        //         'bargain_price' => $tdb->bargain_price,
        //         'history_bargain_id' => $tempBargain->bargain_id
        //     ];
        //     BargainHistoryDetail::create($bargainDetailDataHistory);
        // }

        TempBargain::where('temp_bargain_id', session('temp_bargain_id_edit'))->delete();
        TempBargainDetail::where('temp_bargain_id', session('temp_bargain_id_edit'))->delete();
        session()->forget('temp_bargain_id_edit');

        return response([
            'status' => 'ok'
        ]);
    }

    public function printToPDF($bargain_id)
    {
        $getBargain = Bargain::join('users', 'users.id_user', '=', 'bargains.created_by')->join('customers', 'customers.customer_id', '=', 'bargains.customer_id')->where('bargain_id', $bargain_id)->select('bargain_id', 'customers.fullname as customer', 'users.fullname as created_by', 'discount', 'discount_type', 'bargain_note', 'bargain_expr', 'updated_by', 'bargain_id_format')->first();

        $getDetailBargain = BargainDetail::where('bargain_id', $bargain_id)->get();

        $getUpdatedBy = User::select('fullname')->where('id_user', $getBargain->updated_by)->first();

        $data = [
            'getUpdatedBy' => $getUpdatedBy,
            'detailBargain' => $getDetailBargain,
            'bargain' => $getBargain,
            'subTotal' => $this->calculateSubTotal($bargain_id, null)
        ];
        
        // return view('pdf.bargains', $data);
        
        $pdf = PDF::loadView('pdf.bargains', $data);
        return $pdf->stream('bargains.pdf');
    }
}
