<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrder = PurchaseOrder::join('suppliers', 'purchase_orders.sup_id', '=', 'suppliers.sup_id')
        ->select('purchase_orders.po_id', 'suppliers.sup_name', 'purchase_orders.discount', 'purchase_orders.type', 'purchase_orders.date')->get();

        return view('sales.purchase-order.purchase-orders', [
            'pageTitle' => 'Purchase Order',
            'purchaseOrder' => $purchaseOrder
        ]);
    }
}
