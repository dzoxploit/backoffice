<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceB2BController extends Controller
{
    public function index(){

        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://api2.anyoneserver.com/public');
        $invoiceb2b = $request->getBody()->getContents();
        $data = json_decode($invoiceb2b);
        return view('invoice-b2b.list_invoice_b2b',['pageTitle' => 'Tagihan Pesanan B2C','data' => $data]);
    }
    public function show($trans_id){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://api2.anyoneserver.com/public/show/'.$trans_id);
        $invoiceb2b = $request->getBody()->getContents();
        $data = json_decode($invoiceb2b);
        $data_invoice = $data->data_transaction;
        $detail_invoice = $data->data_detail;
        $pageTitle = 'Detail Pesanan B2C';
        return view('invoice-b2b.view_invoice_b2b',['data_invoice' => $data_invoice, 'detail_invoice' => $detail_invoice, 'pageTitle' => $pageTitle]);
    }
    public function cetak($trans_id){
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://api2.anyoneserver.com/public/cetak/'.$trans_id);
        $invoiceb2b = $request->getBody()->getContents();
        $data = json_decode($invoiceb2b);
        $data_invoice = $data->data_transaction;
        $detail_invoice = $data->data_detail;
        $tanggal_sekarang = Carbon::now();
        $data =  [
            'data_invoice' => $data_invoice,
            'detail_invoice' => $detail_invoice,
            'tanggal_sekarang' => $tanggal_sekarang,
        ];
        $pdf = PDF::loadView('invoice-b2b.pdf_invoice_b2b', $data);
        return $pdf->stream('surat-jalan-tagihan-b2c-'.$data_invoice->trans_invoice.'.pdf');
    }
}
