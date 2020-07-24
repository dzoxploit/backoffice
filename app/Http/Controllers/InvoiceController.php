<?php

namespace App\Http\Controllers;

use App\DetailPurchaseOrder;
use App\Invoice;
use App\PurchaseOrder;
use App\Supplier;
use App\TempDetailPurchaseOrder;
use App\TempPurchaseOrderCustomer;
use Carbon\Carbon;
use App\BuktiBayar;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        // $invoice = Invoice::join('bukti_bayar','bukti_bayar.invoice_id','=','invoices.invoice_id')->where('bukti_bayar.invoice_id','!=',null)->orderBy('created_at', 'DESC')->get();

        $invoice = Invoice::orderBy('created_at', 'DESC')->get();
        return view('invoices.invoice', [
            'pageTitle' => 'Invoice',
            'invoices' => $invoice
        ]);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $tempPo = [];
        $tempDetailPo = [];

        return view('invoices.create', [
            'pageTitle' => 'New Invoice',
            'suppliers' => $suppliers,
            'tempPo' => $tempPo,
            'tempDetailPo' => $tempDetailPo
        ]);
    }

    public function check()
    {
        $poIdExplode = explode("/",request('po_id'));

        $arrangePoIdFormat = [
            $poIdExplode['1'],
            $poIdExplode['2'],
            $poIdExplode['3'],
            $poIdExplode['4'],
        ];

        $poId = ltrim($poIdExplode['0'], '0');
        $po_id_format = '/'.implode('/', $arrangePoIdFormat);

        $purchaseOrder = PurchaseOrder::where('po_id', $poId)->where('po_id_format', $po_id_format)->count();

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
    public function get_invoice_id($invoice_id){
        $id_data = $invoice_id;
        return response()->json($id);
    }
    public function bukti_bayar(Request $request){

        $attachment = request()->file('payment_proof');
        $path = $attachment->store('attachment', 'public');

        $buktibayar = new BuktiBayar;
        $buktibayar->invoice_id = $request->invoice_id;
        $buktibayar->paid = $request->paid;
        $buktibayar->paid_date = $request->paid_date;
        $buktibayar->confirm_date = Carbon::now();
        $buktibayar->payment_proof = $path;
        $buktibayar->payment_method = $request->payment_method;
        $buktibayar->note = $request->note;
        $buktibayar->save();
        return redirect()->back();
    }
    public function store()
    {
        $poIdExplode = explode("/",request('invoicePoId'));

        $arrangePoIdFormat = [
            $poIdExplode['1'],
            $poIdExplode['2'],
            $poIdExplode['3'],
            $poIdExplode['4'],
        ];

        $poId = ltrim($poIdExplode['0'], '0');
        $po_id_format = '/'.implode('/', $arrangePoIdFormat);

        $attachment = request()->file('invoiceAttachment');
        $path = $attachment->store('attachment', 'public');

        $invoiceData = [
            'po_id' => $poId,
            'po_id_format' => $po_id_format,
            'invoice_attachment' => $path,
            'no_invoice' => request('invoiceNum'),
            'due_date' => request('due-date'),
            'note' => request('note'),
            'ppn' => request('ppn') == 'on' ? 10 : 0,
            'paid_at' => null,
            'paid_price' => request('paid_price'),
            'id_user' => session('id_user')
        ];

        Invoice::create($invoiceData);

        session()->flash('Success', 'Data berhasil dimasukan');

        return redirect('/invoices');
    }

    public function detail($invoice_id)
    {
        $getInvoice = Invoice::where('invoice_id', $invoice_id)->first();

        return view('invoices.detail', [
            'pageTitle' => 'Detail Invoice',
            'invoice' => $getInvoice,
            'poTotal' => $this->calculateSubTotal($getInvoice->po_id)
        ]);
    }

    public function destroy($invoice_id)
    {
        Invoice::where('invoice_id', $invoice_id)->delete();

        return redirect()->back();
    }

    public function calculateSubTotal($po_id)
    {
        $temp = PurchaseOrder::where('po_id', $po_id)->select('discount', 'type')->first();

        $tempDetail = DetailPurchaseOrder::where([
            'po_id' => $po_id,
        ])->select('qty', 'price', 'discount')->get();

        $itemsPrice = array();
        foreach ($tempDetail as $tDetail) {
            $hargaDetail = $tDetail->price * $tDetail->qty;
            $discount = ($tDetail->discount / 100) * $hargaDetail;
            $total = $hargaDetail - $discount;
            $itemsPrice[] = intval($total);
        }
        $subTotal = array_sum($itemsPrice);

        if ($temp->type == '%') {
            $po_discount = $subTotal * ($temp->discount/100);
            $subTotalDiscount = $subTotal - $po_discount;
        }else if ($temp->type == '$') {
            $subTotalDiscount = ($subTotal - $temp->discount);
        }

        return $subTotalDiscount ;
    }

    public function calcDiscountData($po_id)
    {
        $purchaseOrder = PurchaseOrder::select('discount', 'type')->where('po_id', $po_id)->first();
        if ($purchaseOrder) {
            if ($purchaseOrder->type == '$') {
                $subTotal = $this->calculateSubTotal($po_id);
                $discount = $subTotal - intval($purchaseOrder->discount);

                return $discount;
            } else if ($purchaseOrder->type == '%') {
                $subTotal = $this->calculateSubTotal($po_id);
                $discount = $subTotal * intval($purchaseOrder->discount) / 100;

                return $subTotal - $discount;
            }
        } else {
            return false;
        }
    }

    public function getCalcDiscountData()
    {
        $poIdExplode = explode("/",request('po_id'));

        $arrangePoIdFormat = [
            $poIdExplode['1'],
            $poIdExplode['2'],
            $poIdExplode['3'],
            $poIdExplode['4'],
        ];

        $poId = ltrim($poIdExplode['0'], '0');
        $po_id_format = '/'.implode('/', $arrangePoIdFormat);

        $calcSubTotal = $this->calcDiscountData($poId);

        if ($calcSubTotal) {
            return response([
                'totalPrice' => "Rp. " . number_format($calcSubTotal, 2, ',', '.')
            ]);
        } else {
            return response([
                'totalPrice' => "Rp. " . number_format(0, 2, ',', '.')
            ]);
        }
    }

    public function getCalcPpnData(bool $ppn, $po_id)
    {
        if ($ppn) {
            $ppnCalc = $this->calcDiscountData($po_id) * 10 / 100;

            return $ppnCalc;
        } else {
            return 0;
        }
    }

    public function getTotalInvoicePrice()
    {
        $poIdExplode = explode("/",request('po_id'));

        $arrangePoIdFormat = [
            $poIdExplode['1'],
            $poIdExplode['2'],
            $poIdExplode['3'],
            $poIdExplode['4'],
        ];

        $poId = ltrim($poIdExplode['0'], '0');
        $po_id_format = '/'.implode('/', $arrangePoIdFormat);

        $poTotal = $this->calcDiscountData($poId);
        $ppnCalc = $this->getCalcPpnData((request('ppn') == 'true'), $poId);

        $invoiceTotal = $poTotal + $ppnCalc;
        return response([
            'subTotal' => "Rp. " . number_format($poTotal, 2, ',', '.'),
            'ppn' => "Rp. " . number_format($ppnCalc, 2, ',', '.'),
            'invoiceTotal' => "Rp. " . number_format($invoiceTotal, 2, ',', '.')
        ]);
    }
}
