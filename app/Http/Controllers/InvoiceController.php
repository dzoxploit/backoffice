<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\PurchaseOrder;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = Invoice::all();
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
        $purchaseOrder = PurchaseOrder::where('po_id', request('po_id'))->count();
        if ($purchaseOrder > 0) {
            return response([
                'message' => 'Valid',
                'msg_status' => 'po_is_valid'
            ]);
        }else {
            return response([
                'message' => 'Not Valid',
                'msg_status' => 'po_not_valid'
            ]);
        }
        
    }

    public function store()
    {
        $invoiceData = [
            'no_invoice' => request('no-invoice'),
            'invoice_date' => Carbon::now(),
            'po_id' => request('po-id'),
            'confirm_date' => null, 
            'due_date' => request('due-date'),
            'note' => request('note'),
            'id_user' => session('id_user')
        ];

        Invoice::create($invoiceData);

        return redirect('invoices');
    }

    public function destroy($invoice_id)
    {
        Invoice::where('invoice_id', $invoice_id)->delete();

        return redirect()->back();
    }
}
