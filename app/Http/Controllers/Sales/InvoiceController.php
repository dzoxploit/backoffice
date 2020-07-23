<?php

namespace App\Http\Controllers\Sales;

use App\Customer;
use App\DetailPurchaseOrderCustomer;
use App\Http\Controllers\Controller;
use App\PurchaseOrderCustomer;
use App\SalesInvoice;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use PurchaseOrderCustomerSeeder;

class InvoiceController extends Controller
{
    public function index($po = false)
    {
        if ($po) {
            $poCustomer = PurchaseOrderCustomer::join('customers', 'purchase_order_customers.customer_id', '=', 'customers.customer_id')->select('po_id', 'po_num', 'bargain_id', 'customers.fullname', 'po_discount', 'po_discount_type', 'purchase_order_customers.created_at', 'po_id_format')->orderBy('purchase_order_customers.created_at', 'DESC')->get();
            return view('sales.invoice.polist', [
                'pageTitle' => 'Invoice Penjualan',
                'cardName' => 'Purchase Orders',
                'salesPo' => $poCustomer
            ]);
        }else {
            $invoice = SalesInvoice::join('customers', 'sales_invoices.bill_to', '=', 'customers.customer_id')->select('invoice_id', 'invoice_id_format', 'customers.fullname as bill_to' ,'terms', 'due_date')->orderBy('sales_invoices.created_at', 'DESC')->get();
            return view('sales.invoice.invoices', [
                'pageTitle' => 'Invoice Penjualan',
                'cardName' => 'Invoice',
                'invoices' => $invoice,
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
        $poCustomer = PurchaseOrderCustomer::join('customers', 'purchase_order_customers.customer_id', '=', 'customers.customer_id')->select('po_id', 'po_id_format')->where('po_id', $po_id)->first();

        if (empty($poCustomer)) {
            return redirect()->back();
        }else {
            $customers = Customer::all();
            $poCustomerDetail = DetailPurchaseOrderCustomer::where('po_id', $po_id)->get();
    
            return view('sales.invoice.create', [
                'pageTitle' => 'Invoice Penjualan Baru',
                'customers' => $customers,
                'poCustomer' => $poCustomer,
                'poCustomerDetail' => $poCustomerDetail,
            ]);
        }
    }

    public function store()
    {
        $invoice_id_format = '/INVOICE/DM/'.request('inputSalesInvoiceInvoiceIdCreateRomawi').'/'.request('inputSalesInvoiceInvoiceIdCreateYear');

        $invoiceData = [
            'invoice_id_format' => $invoice_id_format,
            'po_id' => request('po_id'),
            'bill_to' => request('inputSalesInvoiceBillTo'),
            'ship_to' => request('inputSalesInvoiceShipTo'),
            'tax_invoice' => request('inputSalesInvoiceTax'),
            'terms' => request('inputSalesInvoiceTerms'),
            'due_date' => now()->addDays(request('inputSalesInvoiceTerms')),
            'ship_via' => request('inputSalesInvoiceShipVia'),
            'ship_date' => request('inputSalesInvoiceShipDate'),
            'spell' => request('inputSalesInvoiceSpell'),
            'ppn' => request('inputSalesInvoicePPN') == 'on' ? 10 : null,
            'freight' => request('inputSalesInvoiceFreight'),
            'notes' => request('inputSalesInvoiceNote'),
            'payment_method' => null,
            'paid_at' => null,
        ];
        
        SalesInvoice::create($invoiceData);

        return redirect('/sales/invoices');
    }

    public function detail($invoice_id)
    {
        $salesInvoice = SalesInvoice::join('customers', 'sales_invoices.bill_to', '=', 'customers.customer_id')->join('purchase_order_customers as poc', 'sales_invoices.po_id', '=', 'poc.po_id')->select('invoice_id', 'invoice_id_format', 'poc.po_id', 'poc.po_id_format' , 'customers.fullname as bill_to' ,'terms', 'ship_date', 'ship_via', 'tax_invoice', 'spell', 'notes', 'ppn', 'freight', 'ship_to')->where('invoice_id', $invoice_id)->first();

        $poCustomerDetail = DetailPurchaseOrderCustomer::where('po_id', $salesInvoice->po_id)->get();

        $totalPrice = $this->calcDetailTotalPrice($salesInvoice->po_id, $salesInvoice->ppn, $salesInvoice->freight);

        return view('sales.invoice.detail', [
            'pageTitle' => 'Detail Invoice Penjualan',
            'salesInvoice' => $salesInvoice,
            'poCustomerDetail' => $poCustomerDetail,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function calcDetailTotalPrice($po_id, $ppn = 0, $freight = 0)
    {
         // Calc Total
         $subTotal = $this->calculateSubTotal($po_id);
         $ppnPrice = $this->calcPpn($ppn == 10 ? true : false, $po_id);
         $freight = intval($freight);
 
         $total = $subTotal + $ppnPrice + $freight;

         return [
             'ppn' => "Rp. " . number_format($ppnPrice, 2, ',', '.'), 
             'freight' => "Rp. " . number_format($freight, 2, ',', '.'),
             'subTotalPrice' => "Rp. " . number_format($subTotal, 2, ',', '.'),
             'invoiceTotal' => "Rp. " . number_format($total, 2, ',', '.')
         ];
    }

    /**
     * search purchase order by customer name (belom)
     */
    public function searchPo()
    {
        $keywords = request('keywords');

        $customers = Customer::where('fullname', 'like%', $keywords)->select('customer_id')->get();
        $purchaseOrderCustomers = PurchaseOrderCustomer::whereIn('customer_id', $customers)->select('po_id', 'po_note')->get();

        $poItems = array();
        foreach ($purchaseOrderCustomers as $poc) {
            $renderRow  = '<tr>';
            $renderRow .= '<td>' . $poc->po_id. '</td>';
            $renderRow .= '<td>' . $poc->po_note . '</td>';
            $renderRow .= '<td>';
            $renderRow .= '<button type="button" class="btn btn-primary" prod-id="' . $poc->po_id . '">';
            $renderRow .= 'Choose';
            $renderRow .= '</button>';
            $renderRow .= '</td>';

            $poItems[] = $renderRow;
        }

        return $poItems;
    }

    public function calculateSubTotal($po_id = null)
    {
        if ($po_id != null) {
            $poCustomer = PurchaseOrderCustomer::where([
                'po_id' => $po_id
            ])->select('po_discount', 'po_discount_type')->first();
            $detail = DetailPurchaseOrderCustomer::where([
                'po_id' => $po_id,
            ])->select('qty', 'unit_price')->get();

            $itemsPrice = array();
            foreach ($detail as $dtl) {
                $hargaDetail = $dtl->unit_price * $dtl->qty;
                $itemsPrice[] = intval($hargaDetail);
            }

            if ($poCustomer->po_discount_type == '$') {
                $hargaTotal = array_sum($itemsPrice) - $poCustomer->po_discount;
            }elseif ($poCustomer->po_discount_type == '%') {
                $hargaDiscount = array_sum($itemsPrice) * $poCustomer->po_discount/100;
                $hargaTotal = array_sum($itemsPrice) - $hargaDiscount;
            }

            return $hargaTotal;
        }else {
            return false;
        }
    }

    public function calcPpn(bool $ppn = false, $po_id)
    {
        if ($ppn) {
            $ppnValue = 10/100;
            $ppnCalc = $this->calculateSubTotal($po_id) * $ppnValue;

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
        $subTotal = $this->calculateSubTotal(request('po_id'));
        $ppn = $this->calcPpn((request('ppn') == 'true') ? true : false, request('po_id'));
        $freight = intval(request('freight'));

        $total = $subTotal + $ppn + $freight;
        return response([
            'ppn' => "Rp. " . number_format($ppn, 2, ',', '.'), 
            'subTotalPrice' => "Rp. " . number_format($subTotal, 2, ',', '.'),
            'invoiceTotal' => "Rp. " . number_format($total, 2, ',', '.')
        ]);
    }

    public function getWarehouseAddress()
    {
        $customer = Customer::where('customer_id', request('customer_id'))->select('address', 'warehouse_address')->first();

        $renderOption = '<option value="0">Choose Customer</option>';
        $renderOption .= '<option value="'.$customer->address.'">'.$customer->address.'</option>';
        $renderOption .= '<option value="'.$customer->warehouse_address.'">'.$customer->warehouse_address.'</option>';

        return $renderOption;
    }

    public function printToPDF($invoice_id)
    {
        $salesInvoice = SalesInvoice::join('customers', 'sales_invoices.bill_to', '=', 'customers.customer_id')->join('purchase_order_customers as poc', 'sales_invoices.po_id', '=', 'poc.po_id')->select('invoice_id', 'invoice_id_format', 'poc.po_id', 'poc.po_id_format' , 'customers.fullname as bill_to' ,'terms', 'ship_date', 'ship_via', 'tax_invoice', 'spell', 'notes', 'ppn', 'freight', 'ship_to', 'sales_invoices.created_at')->where('invoice_id', $invoice_id)->first();

        $poCustomerDetail = DetailPurchaseOrderCustomer::where('po_id', $salesInvoice->po_id)->get();

        $totalPrice = $this->calcDetailTotalPrice($salesInvoice->po_id, $salesInvoice->ppn, $salesInvoice->freight);

        $data =  [
            'salesInvoice' => $salesInvoice,
            'poCustomerDetail' => $poCustomerDetail,
            'totalPrice' => $totalPrice,
        ];

        // return view('pdf.invoice', $data);

        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->stream('invoice.pdf');
    }
}
