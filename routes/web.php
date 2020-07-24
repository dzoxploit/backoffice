<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;


Route::get('/login', 'AuthController@index');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');


Route::middleware(['myMiddleWare'])->group(function(){
    Route::get('/', 'DashboardController@index');


    //////////////////////////////
    /* Master Users */
    /////////////////////////////
    Route::get('/users', 'UserController@index');
    Route::get('/users/new', 'UserController@create');
    Route::get('/users/roles/ajax', 'UserController@getRoles');
    Route::post('/users/new', 'UserController@store');

    Route::put('users/{id_user}', 'UserController@update');
    Route::delete('users/{id_user}', 'UserController@destroy');
    Route::get('users/{id_user}', 'UserController@detail');
    Route::get('users/{id_user}/edit', 'UserController@show');
    Route::get('/users/{id_user}/changepassword', 'UserController@showChangePassword');
    Route::post('/users/{id_user}/changepassword', 'UserController@changePassword');

    //////////////////////////////
    /* Master Roles */
    /////////////////////////////
    Route::get('/roles', 'UserController@roles');
    Route::get('/roles/ajax', 'UserController@getRoles');
    Route::post('/roles/new', 'UserController@storeRole');
    Route::put('/roles/{role_id}', 'UserController@update');
    Route::delete('/roles/{role_id}', 'UserController@destroyRole');

    //////////////////////////////
    /* Master Unit */
    /////////////////////////////
    Route::get('/unit', 'UnitController@index');


    //////////////////////////////
    /* Master Otorisasi */
    /////////////////////////////
    Route::get('/authorizations', 'AuthorizationController@index');
    Route::get('/authorizations/new', 'AuthorizationController@create');
    Route::post('/authorizations/new', 'AuthorizationController@store');
    Route::get('/authorizations/{authorization_id}/edit', 'AuthorizationController@show');
    Route::patch('/authorizations/{authorization_id}', 'AuthorizationController@update');
    Route::delete('/authorizations/{authorization_id}', 'AuthorizationController@destroy');


    //////////////////////////////
    /* Suppliers */
    /////////////////////////////
    Route::get('suppliers', 'SupplierController@index');
    Route::get('suppliers/new', 'SupplierController@create');
    Route::post('suppliers/new', 'SupplierController@store');
    Route::get('suppliers/{sup_id}', 'SupplierController@detail');
    Route::put('suppliers/{sup_id}', 'SupplierController@update');
    Route::get('suppliers/{sup_id}/edit', 'SupplierController@show');
    Route::delete('suppliers/{sup_id}', 'SupplierController@destroy');

    //////////////////////////////
    /* Purchase Orders */
    /////////////////////////////
    Route::get('/purchaseorders', 'PurchaseOrderController@index');
    Route::get('/purchaseorders/new', 'PurchaseOrderController@create');
    Route::post('/purchaseorders/new', 'PurchaseOrderController@store');
    Route::get('/purchaseorders/product', 'PurchaseOrderController@showProduct');
    Route::post('/purchaseorders/temp/store', 'PurchaseOrderController@tempStore');
    Route::get('/purchaseorders/temp/reset', 'PurchaseOrderController@resetTempPo');
    Route::get('/purchaseorders/detail/calculation/ajax', 'PurchaseOrderController@getCalcData');
    Route::get('/purchaseorders/detail/calculation/discount/ajax', 'PurchaseOrderController@getCalcDiscountData');
    Route::patch('/purchaseorders/temp/detail/edit', 'PurchaseOrderController@updateTempDetail');
    Route::get('/purchaseorders/po/calculation/total/ajax', 'PurchaseOrderController@calcTotal');
    Route::post('/purchaseorders/search/product', 'PurchaseOrderController@searchProduct');


    Route::post('/purchaseorders/temp/detail/{prod_id}', 'PurchaseOrderController@storeTempDetail');
    Route::get('/purchaseorders/{po_id}', 'PurchaseOrderController@detail');
    Route::delete('/purchaseorders/{po_id}', 'PurchaseOrderController@destroy');
    Route::delete('/purchaseorders/temp/detail/{prod_id}', 'PurchaseOrderController@destroyProduct');
    Route::get('/purchaseorders/detail/{prod_id}/ajax', 'PurchaseOrderController@getTempDetail');
    Route::get('/purchaseorders/print/pdf/{po_id}', 'PurchaseOrderController@printToPDF');


    //Invoice
    Route::get('/invoices', 'InvoiceController@index');
    Route::get('/invoices/check/ajax', 'InvoiceController@check');
    Route::get('/invoices/new', 'InvoiceController@create');
    Route::post('/invoices/new', 'InvoiceController@store');
    Route::get('/invoices/{invoice_id}', 'InvoiceController@detail');
    Route::get('/invoices/{invoice_id}/edit', 'InvoiceController@show');
    Route::put('/invoices/{invoice_id}', 'InvoiceController@update');
    Route::delete('/invoices/{invoice_id}', 'InvoiceController@destroy');
    Route::get('/invoices/po/calculation/discount/ajax', 'InvoiceController@getCalcDiscountData');
    Route::get('/invoices/invoice/calculation/total/ajax', 'InvoiceController@getTotalInvoicePrice');

    //Bukti Bayar Invoice
    Route::post('/invoices/bukti-bayar','InvoiceController@bukti_bayar');
    //////////////////////////////
    /* Delivery Orders */
    /////////////////////////////
    Route::get('/deliveryorders', 'DeliveryOrderController@index');
    Route::get('/deliveryorders/po', 'DeliveryOrderController@poList');
    Route::get('/deliveryorders/new', 'DeliveryOrderController@create');
    Route::post('/deliveryorders/new', 'DeliveryOrderController@store');
    Route::get('/deliveryorders/product', 'DeliveryOrderController@showProduct');
    Route::get('/deliveryorders/check/ajax', 'DeliveryOrderController@check');
    Route::post('/deliveryorders/temp/save', 'DeliveryOrderController@storeTemp');
    Route::delete('/deliveryorders/temp/reset', 'DeliveryOrderController@destroyTemp');
    Route::get('/deliveryorders/detail/ajax', 'DeliveryOrderController@getDetail');
    Route::patch('/deliveryorders/detail', 'DeliveryOrderController@updateDetail');

    Route::post('/deliveryorders/product/{product_id}', 'DeliveryOrderController@storeProduct');
    Route::get('/deliveryorders/{delivery_id}', 'DeliveryOrderController@detail');
    Route::get('/deliveryorders/{delivery_id}/edit', 'DeliveryOrderController@show');
    Route::put('/deliveryorders/{delivery_id}', 'DeliveryOrderController@update');
    Route::delete('/deliveryorders/{delivery_id}', 'DeliveryOrderController@destroy');
    Route::delete('/deliveryorders/detail/{prod_id}', 'DeliveryOrderController@destroyDetail');

    //////////////////////////////
    /* Sales Couriers */
    /////////////////////////////

    Route::get('/couriers', 'CourierController@index');
    Route::get('/couriers/new', 'CourierController@create');
    Route::post('/couriers/new', 'CourierController@store');
    Route::get('/couriers/{courier_id}/edit', 'CourierController@show');
    Route::patch('/couriers/{courier_id}', 'CourierController@update');
    Route::delete('/couriers/{courier_id}', 'CourierController@destroy');


    Route::get('/sales/customers', 'Sales\CustomerController@index');
    Route::get('/sales/customers/new', 'Sales\CustomerController@create');
    Route::post('/sales/customers/new', 'Sales\CustomerController@store');
    Route::get('/sales/customers/{customer_id}/edit', 'Sales\CustomerController@show');
    Route::patch('/sales/customers/{customer_id}', 'Sales\CustomerController@edit');
    Route::delete('/sales/customers/{customer_id}', 'Sales\CustomerController@destroy');

    //////////////////////////////
    /* Sales Purchase Order */
    /////////////////////////////
    Route::get('/sales/purchaseorders', 'Sales\PurchaseOrderCustomerController@index');
    Route::get('/sales/purchaseorders/new', 'Sales\PurchaseOrderCustomerController@create');
    Route::post('/sales/purchaseorders/new', 'Sales\PurchaseOrderCustomerController@store');
    Route::get('/sales/purchaseorders/product', 'Sales\PurchaseOrderCustomerController@showProduct');
    Route::get('/sales/purchaseorders/temp/reset', 'Sales\PurchaseOrderCustomerController@resetTempPo');
    Route::post('/sales/purchaseorders/temp/store', 'Sales\PurchaseOrderCustomerController@tempStore');
    Route::patch('/sales/purchaseorders/temp/detail', 'Sales\PurchaseOrderCustomerController@updateTempDetail');
    Route::post('/sales/purchaseorders/search/product', 'Sales\PurchaseOrderCustomerController@searchProduct');
    Route::post('/sales/purchaseorders/detail/calculation/ajax', 'Sales\PurchaseOrderCustomerController@getCalcData');
    Route::post('/sales/purchaseorders/check/ajax', 'Sales\PurchaseOrderCustomerController@check');
    Route::post('/sales/purchaseorders/justcheck/ajax', 'Sales\PurchaseOrderCustomerController@justCheckBargainId');
    Route::get('/sales/purchaseorders/detail/calculation/discount/ajax', 'Sales\PurchaseOrderCustomerController@getCalcDiscountData');

    Route::post('/sales/purchaseorders/temp/detail/{prod_id}', 'Sales\PurchaseOrderCustomerController@storeTempDetail');
    Route::delete('/sales/purchaseorders/temp/detail/{prod_id}', 'Sales\PurchaseOrderCustomerController@destroyProductTempDetail');
    Route::get('/sales/purchaseorders/detail/{product_id}/ajax', 'Sales\PurchaseOrderCustomerController@getTempDetail');
    Route::get('/sales/purchaseorders/{po_id}', 'Sales\PurchaseOrderCustomerController@detail');
    Route::delete('/sales/purchaseorders/{po_id}', 'Sales\PurchaseOrderCustomerController@destroy');
    Route::get('/sales/bargains/detail/calculation/discount/ajax', 'Sales\BargainCustomerController@getCalcDiscountData');


    //bargain
    Route::get('/sales/bargains', 'Sales\BargainCustomerController@index');
    Route::get('/sales/bargains/new', 'Sales\BargainCustomerController@create');
    Route::post('/sales/bargains/new', 'Sales\BargainCustomerController@store');
    Route::post('/sales/bargains/temp/store', 'Sales\BargainCustomerController@tempStore');
    Route::post('/sales/bargains/product/edit/ajax', 'Sales\BargainCustomerController@showProductForEdit');
    Route::post('/sales/bargains/product/save/ajax', 'Sales\BargainCustomerController@showProductForSave');
    Route::post('/sales/bargains/temp/detail/{prod_id}', 'Sales\BargainCustomerController@storeTempDetail');
    Route::post('/sales/bargains/temp/detail/{prod_id}/edit', 'Sales\BargainCustomerController@storeTempDetailEdit');
    Route::post('/sales/bargains/detail/calculation/ajax', 'Sales\BargainCustomerController@getCalcData');
    Route::get('/sales/bargains/detail/calculation/discount/ajax', 'Sales\BargainCustomerController@getCalcDiscountData');
    Route::get('/sales/bargains/detail/{prod_id}/ajax', 'Sales\BargainCustomerController@getTempDetail');
    Route::patch('/sales/bargains/temp/detail', 'Sales\BargainCustomerController@updateTempDetail');
    Route::delete('/sales/bargains/temp/detail/{prod_id}', 'Sales\BargainCustomerController@destroyProductTempDetail');
    Route::get('/sales/bargains/temp/reset', 'Sales\BargainCustomerController@resetTempBargain');
    Route::delete('/sales/bargains/temp/edit/default', 'Sales\BargainCustomerController@defaultTempBargainEdit');
    Route::delete('/sales/bargains/{bargain_id}', 'Sales\BargainCustomerController@destroy');
    Route::get('/sales/bargains/{bargain_id}', 'Sales\BargainCustomerController@detail');
    Route::get('/sales/bargains/{bargain_id}/edit', 'Sales\BargainCustomerController@show');
    Route::delete('/sales/bargains/{bargain_id}/cancel', 'Sales\BargainCustomerController@cancelTempBargainEdit');

    Route::post('/sales/bargains/temp/edit', 'Sales\BargainCustomerController@tempUpdate');
    Route::patch('/sales/bargains/{bargain_id}', 'Sales\BargainCustomerController@update');

    Route::get('/sales/bargains/print/pdf/{bargain_id}', 'Sales\BargainCustomerController@printToPDF');



    //////////////////////////////
    /* Sales Invoice */
    /////////////////////////////
    Route::get('/sales/invoices', 'Sales\InvoiceController@index');
    Route::get('/sales/invoices/po', 'Sales\InvoiceController@poList');
    Route::get('/sales/invoices/new', 'Sales\InvoiceController@create');
    Route::post('/sales/invoices/new', 'Sales\InvoiceController@store');
    Route::post('/sales/invoices/search/po', 'Sales\InvoiceController@searchPo');
    Route::post('/sales/invoices/detail/calculation/ajax', 'Sales\InvoiceController@getCalcData');
    Route::get('/sales/invoices/invoice/calculation/total/ajax', 'Sales\InvoiceController@calcTotal');
    Route::post('/sales/invoices/invoice/shipto/ajax', 'Sales\InvoiceController@getWarehouseAddress');

    Route::get('/sales/invoices/pdf/{invoice_id}', 'Sales\InvoiceController@printToPDF');
    Route::get('/sales/invoices/{invoice_id}', 'Sales\InvoiceController@detail');

    //////////////////////////////
    /* Invoice Bussiness to Customer */
    /////////////////////////////
    Route::get('/tagihan-pesanan-b2c','InvoiceB2BController@index');
    Route::get('/tagihan-pesanan-b2c/show/{trans_id}','InvoiceB2BController@show');
    Route::get('/cetak-surat-jalan-tagihan-b2c/{trans_id}','InvoiceB2BController@cetak');
});
Route::get('changelog', function(){
    return base_path('changelog');
});

Route::get('testing', function(){
    return session()->all();
});

Route::get('session/testing', function(){
    session()->put('temp_do_id', 1);
});

Route::get('invoicepdf', function(){
    return view('pdf.invoice');
});
