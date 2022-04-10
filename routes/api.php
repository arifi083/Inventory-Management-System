<?php



 
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');
Route::apiResource('/customer', 'Api\CustomerController');

Route::Post('/salary/insert/{id}', 'Api\SaleryController@saleryInsert');
Route::Get('/salary', 'Api\SaleryController@allSalery');
Route::Get('/salary/view/{id}', 'Api\SaleryController@ViewSalary');
Route::Get('/edit/salary/{id}', 'Api\SaleryController@EditSalary');
Route::Post('/salary/update/{id}', 'Api\SaleryController@SalaryUpdate');

Route::Post('/stock/update/{id}', 'Api\ProductController@StockUpdate');
Route::Get('/getting/product/{id}', 'Api\Poscontroller@getProducts');

Route::Get('/addtocart/{id}', 'Api\CartController@AddToCart');
Route::Get('/cart/product', 'Api\CartController@CartProduct');
Route::Get('/remove/cart/{id}', 'Api\CartController@removeCart');
Route::Get('/increment/{id}', 'Api\CartController@increment');
Route::Get('/decrement/{id}', 'Api\CartController@decrement');

Route::Get('/vats', 'Api\CartController@vat');
Route::Post('/orderdone', 'Api\PosController@OrderDone');

Route::Get('/orders', 'Api\OrderController@TodayOrder');
Route::Get('/order/details/{id}', 'Api\OrderController@OrderDetails');
Route::Get('/order/orderdetails/{id}', 'Api\OrderController@OrderDetailsAll');
Route::Post('/search/order', 'Api\PosController@SearchOrderDate');


Route::Get('/today/sell','Api\PosController@TodaySell');
Route::Get('/today/income','Api\PosController@TodayIncome');
Route::Get('/today/due','Api\PosController@TodayDue');
Route::Get('/today/expense','Api\PosController@TodayExpense');
Route::Get('/today/stockout','Api\PosController@StockOut');