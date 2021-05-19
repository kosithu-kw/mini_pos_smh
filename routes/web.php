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



Route::get('/login',[
    'uses'=>'AuthController@getLogin',
    'as'=>'login'
]);

Route::post('/login',[
    'uses'=>'AuthController@postLogin',
    'as'=>'login'
]);


Route::group(['middleware'=>'auth'], function (){

    Route::get('/', function (){
        return redirect()->route('dashboard');
    });

    Route::group(['prefix'=>'sales','middleware'=>'role:Admin|Manager|Cashier'], function (){
        Route::get('/report/id',[
            'uses'=>'SaleController@getReportId',
            'as'=>'report.id'
        ]);
        Route::get('/report/sale_id/{id}',[
            'uses'=>'SaleController@getReportSaleId',
            'as'=>'report.sale.id'
        ]);
        Route::get('/report/month',[
            'uses'=>'SaleController@getReportMonth',
            'as'=>'report.month'
        ]);
        Route::get('/report/date',[
            'uses'=>'SaleController@getReportDate',
            'as'=>'report.date'
        ]);
        Route::get('/report',[
            'uses'=>'SaleController@getReport',
            'as'=>'sales.report'
        ]);
        Route::post('/sale-to',[
            'uses'=>'SaleController@postSaleTo',
            'as'=>'sale_to'
        ]);
        Route::get('/cancel_sale_to',[
            'uses'=>'SaleController@CancelSaleTo',
            'as'=>'cancel_sale_to'
        ]);
        Route::get('/customers',[
            'uses'=>'CustomersController@getCustomers',
            'as'=>'customers'
        ]);
        Route::get('/customer/{id}/detail',[
            'uses'=>'CustomersController@getCustomerDetail',
            'as'=>'customer.detail'
        ]);
        Route::post('/customer/add',[
            'uses'=>'CustomersController@postAddCustomer',
            'as'=>'customer.add'
        ]);
        Route::get('/customer/{id}/delete',[
            'uses'=>'CustomersController@getDeleteCustomer',
            'as'=>'customer.delete'
        ]);
        Route::post('/customer/update',[
            'uses'=>'CustomersController@postUpdateCustomer',
            'as'=>'customer.update'
        ]);
        Route::post('/customer/change',[
            'uses'=>'SaleController@postChangeCustomer',
            'as'=>'change.customer'
        ]);
    });

    Route::group(['prefix'=>'sales','middleware'=>'role:Admin|Manager|Cashier'], function (){
        Route::get('/print/{id}',[
            'uses'=>'SaleController@print',
            'as'=>'print'
        ]);
        Route::get('/checkout',[
            'uses'=>'SaleController@checkout',
            'as'=>'checkout'
        ]);
        Route::get('/checkout/print',[
            'uses'=>'SaleController@checkOutPrint',
            'as'=>'checkout.print'
        ]);
        Route::get('/cart/cancel',[
            'uses'=>'SaleController@cancelCart',
            'as'=>'cart.cancel'
        ]);
        Route::get('/sale',[
            'uses'=>'SaleController@getSalePage',
            'as'=>'sale'
        ]);
        Route::post('/add/cart',[
            'uses'=>'SaleController@postAddCart',
            'as'=>'add.cart'
        ]);
        Route::post('/add/cart2',[
            'uses'=>'SaleController@postAddCart2',
            'as'=>'add.cart2'
        ]);
        Route::post('/paid/cash',[
            'uses'=>'SaleController@postPaidCash',
            'as'=>'paid.cash'
        ]);
        Route::get('/decrease/cart/{id}',[
            'uses'=>'SaleController@decreaseCart',
            'as'=>'decrease.cart'
        ]);
        Route::get('/increase/cart/{id}',[
            'uses'=>'SaleController@increaseCart',
            'as'=>'increase.cart'
        ]);
        Route::get('/remove/item/{id}',[
            'uses'=>'SaleController@removeItem',
            'as'=>'remove.item'
        ]);
    });

    Route::group(['prefix'=>'products', 'middleware'=>'role:Admin|Manager|Cashier'], function(){
        Route::post('/update/old/item',[
            'uses'=>'ProductController@postUpdateOldItem',
            'as'=>'update.old.item.buy'
        ]);
        Route::get('/update/old/item/{id}',[
            'uses'=>'ProductController@getUpdateOldItem',
            'as'=>'update.old.item'
        ]);
        Route::post('/update/item',[
            'uses'=>'ProductController@postUpdateItem',
            'as'=>'update.item'
        ]);
        Route::get('/get/edit/item/{id}',[
            'uses'=>'ProductController@getEditItem',
            'as'=>'get.edit.item'
        ]);
        Route::get('/show/item/{id}',[
            'uses'=>'ProductController@getShowItem',
            'as'=>'item.show'
        ]);
        Route::get('/item/{id}/remove',[
            'uses'=>'ProductController@getRemoveItem',
            'as'=>'item.remove'
        ]);
        Route::get('/print/barcode',[
            'uses'=>'ProductController@getPrintBarcode',
            'as'=>'print.barcode'
        ]);
        Route::get('/all',[
            'uses'=>'ProductController@getProducts',
            'as'=>'product.all'
        ]);
        Route::get('/new',[
            'uses'=>'ProductController@getNewProduct',
            'as'=>'product.new'
        ]);
        Route::post('/new',[
            'uses'=>'ProductController@postNewProduct',
            'as'=>'product.add'
        ]);
    });


    Route::group(['prefix'=>'user'], function (){
        Route::get('/buy/month',[
            'uses'=>'GraphController@getMonthBuy'
        ]);
        Route::get('/sales/month',[
            'uses'=>'GraphController@getMonthlySale'
        ]);

        Route::get('/account/setting',[
            'uses'=>'AdminController@getUserAccountSetting',
            'as'=>'account.setting'
        ]);
        Route::post('/password/update',[
            'uses'=>'AdminController@postUpdatePassword',
            'as'=>'password.update'
        ]);
        Route::get('/dashboard',[
            'uses'=>'AdminController@getDashboard',
            'as'=>'dashboard'
        ]);

        Route::get('/logout',[
            'uses'=>'AuthController@getLogout',
            'as'=>'logout'
        ]);
        Route::get('/error',[
            'uses'=>'AdminController@getError',
            'as'=>'error'
        ]);
    });




    Route::group(['prefix'=>'admin', 'middleware'=>'role:Admin'], function (){

        Route::get('/users',[
            'uses'=>'AdminController@getUsers',
            'as'=>'users'
        ]);
        Route::get('/user/new',[
            'uses'=>'AdminController@getNewUser',
            'as'=>'user.new'
        ]);
        Route::post('/user/new',[
            'uses'=>'AdminController@postNewUser',
            'as'=>'user.new'
        ]);
        Route::post('/user/delete',[
            'uses'=>'AdminController@postDeleteUser',
            'as'=>'user.delete'
        ]);

        Route::post('/user/update',[
            'uses'=>'AdminController@postUpdateUser',
            'as'=>'user.update'
        ]);

    });



});



