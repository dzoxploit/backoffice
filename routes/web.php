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

    // Users
    Route::get('/users', 'UserController@index');
    Route::get('/users/new', 'UserController@create');
    Route::get('/users/roles/ajax', 'UserController@getRoles');
    Route::post('/users/new', 'UserController@store');
    Route::get('users/{id_user}/edit', 'UserController@show');
    Route::put('users/{id_user}', 'UserController@update');
    Route::delete('users/{id_user}', 'UserController@destroy');

    // Roles
    Route::get('/roles', 'UserController@roles');
    Route::get('/roles/ajax', 'UserController@getRoles');
    Route::post('/roles/new', 'UserController@storeRole');
    Route::put('/roles/{role_id}', 'UserController@update');
    Route::delete('/roles/{role_id}', 'UserController@destroyRole');

    //Suppliers
    Route::get('suppliers', 'SupplierController@index');
    Route::get('suppliers/new', 'SupplierController@create');
    Route::post('suppliers/new', 'SupplierController@store');
    Route::get('suppliers/{sup_id}/edit', 'SupplierController@show');
    Route::put('suppliers/{sup_id}', 'SupplierController@update');
    Route::delete('suppliers/{sup_id}', 'SupplierController@destroy');

    //purchase order
    Route::get('/purchaseorders', 'PurchaseOrderController@index');
    Route::get('/purchaseorders/new', 'PurchaseOrderController@create');
    Route::post('/purchaseorders/new', 'PurchaseOrderController@store');
    Route::get('/purchaseorders/product', 'PurchaseOrderController@showProduct');
    Route::get('/purchaseorders/{po_id}', 'PurchaseOrderController@detail');
    Route::delete('/purchaseorders/{po_id}', 'PurchaseOrderController@destroy');
    Route::post('/purchaseorders/temp/store', 'PurchaseOrderController@tempStore');
    Route::get('/purchaseorders/temp/detail/{prod_id}', 'PurchaseOrderController@storeTempDetail');
    Route::delete('/purchaseorders/temp/detail/{prod_id}', 'PurchaseOrderController@destroyProduct');
    Route::get('/purchaseorders/temp/reset', 'PurchaseOrderController@resetTempPo');
    Route::patch('/purchaseorders/temp/detail', 'PurchaseOrderController@updateTempDetail');
    Route::get('/purchaseorders/detail/calculation/ajax', 'PurchaseOrderController@getCalcData');
    Route::get('/purchaseorders/detail/calculation/discount/ajax', 'PurchaseOrderController@getCalcDiscountData');
    Route::get('/purchaseorders/detail/{prod_id}/ajax', 'PurchaseOrderController@getTempDetail');

    //Invoice
    Route::get('/invoices', 'InvoiceController@index'); 
    Route::get('/invoices/check/ajax', 'InvoiceController@check');
    Route::get('/invoices/new', 'InvoiceController@create');
    Route::post('/invoices/new', 'InvoiceController@store');
    Route::get('/invoices/{invoice_id}/edit', 'InvoiceController@show');
    Route::put('/invoices/{invoice_id}', 'InvoiceController@update');
    Route::delete('/invoices/{invoice_id}', 'InvoiceController@destroy');
    Route::get('/invoices/po/calculation/discount/ajax', 'invoiceController@getCalcDiscountData');
    Route::get('/invoices/po/calculation/ppn/ajax', 'invoiceController@getCalcPpnData');


    /* Begin Delivery Orders */

    //Delivery Orders
    Route::get('/deliveryorders', 'DeliveryOrderController@index'); 
    Route::get('/deliveryorders/new', 'DeliveryOrderController@create');
    Route::post('/deliveryorders/new', 'DeliveryOrderController@store');
    Route::get('/deliveryorders/product', 'DeliveryOrderController@showProduct');
    Route::get('/deliveryorders/{delivery_id}', 'DeliveryOrderController@detail'); 
    Route::get('/deliveryorders/{delivery_id}/edit', 'DeliveryOrderController@show');
    Route::put('/deliveryorders/{delivery_id}', 'DeliveryOrderController@update');
    Route::delete('/deliveryorders/{delivery_id}', 'DeliveryOrderController@destroy');
    Route::get('/deliveryorders/check/ajax', 'DeliveryOrderController@check');

    //Delivery Orders Temporary
    Route::post('/deliveryorders/temp/save', 'DeliveryOrderController@storeTemp');
    Route::delete('/deliveryorders/temp/reset', 'DeliveryOrderController@destroyTemp');

    //Delivery Orders Detail
    Route::get('/deliveryorders/detail/ajax', 'DeliveryOrderController@getDetail');
    Route::get('/deliveryorders/product/{prod_id}', 'DeliveryOrderController@storeProduct');
    Route::patch('/deliveryorders/detail', 'DeliveryOrderController@updateDetail');
    Route::delete('/deliveryorders/detail/{prod_id}', 'DeliveryOrderController@destroyDetail');


    /** Sales **/

    //Couriers
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

    //PurchaseOrders
    Route::get('/sales/purchaseorders', 'Sales\PurchaseOrderCustomerController@index');
    Route::get('/sales/purchaseorders/new', 'Sales\PurchaseOrderCustomerController@create');
    Route::post('/sales/purchaseorders/temp/store', 'Sales\PurchaseOrderCustomerController@tempStore');
    Route::get('/sales/purchaseorders/product', 'Sales\PurchaseOrderCustomerController@showProduct');
    Route::get('/sales/purchaseorders/temp/detail/{prod_id}', 'Sales\PurchaseOrderCustomerController@storeTempDetail');
    Route::get('/sales/purchaseorders/detail/{product_id}/ajax', 'Sales\PurchaseOrderCustomerController@getTempDetail');
    Route::patch('/sales/purchaseorders/temp/detail', 'Sales\PurchaseOrderCustomerController@updateTempDetail');
    Route::delete('/sales/purchaseorders/temp/detail/{prod_id}', 'Sales\PurchaseOrderCustomerController@destroyProductTempDetail');
    Route::get('/sales/purchaseorders/temp/reset', 'Sales\PurchaseOrderCustomerController@resetTempPo');
    Route::post('/sales/purchaseorders/new', 'Sales\PurchaseOrderCustomerController@store');
    Route::get('/sales/purchaseorders/{po_id}', 'Sales\PurchaseOrderCustomerController@detail');
    Route::delete('/sales/purchaseorders/{po_id}', 'Sales\PurchaseOrderCustomerController@destroy');

    //bargain
    Route::get('/sales/bargains', 'Sales\BargainCustomerController@index');
    Route::get('/sales/bargains/new', 'Sales\BargainCustomerController@create');
    Route::post('/sales/bargains/new', 'Sales\BargainCustomerController@store');
    Route::post('/sales/bargains/temp/store', 'Sales\BargainCustomerController@tempStore');
    Route::get('/sales/bargains/product', 'Sales\BargainCustomerController@showProduct');
    Route::get('/sales/bargains/temp/detail/{prod_id}', 'Sales\BargainCustomerController@storeTempDetail');
    Route::get('/sales/bargains/detail/calculation/ajax', 'Sales\BargainCustomerController@getCalcData');
    Route::get('/sales/bargains/detail/calculation/discount/ajax', 'Sales\BargainCustomerController@getCalcDiscountData');
    Route::get('/sales/bargains/detail/{prod_id}/ajax', 'Sales\BargainCustomerController@getTempDetail');
    Route::patch('/sales/bargains/temp/detail', 'Sales\BargainCustomerController@updateTempDetail');
    Route::delete('/sales/bargains/temp/detail/{prod_id}', 'Sales\BargainCustomerController@destroyProductTempDetail');
    Route::get('/sales/bargains/temp/reset', 'Sales\BargainCustomerController@resetTempBargain');
    Route::delete('/sales/bargains/{bargain_id}', 'Sales\BargainCustomerController@destroy');
    Route::get('/sales/bargains/{bargain_id}', 'Sales\BargainCustomerController@detail');


  



    
});

Route::get('testing', function(){
    return session()->all();
});

