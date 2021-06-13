<?php

use Illuminate\Support\Facades\Route;

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

  //login
Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@authenticate')->name('login.confirm');


Route::group(['middleware' => 'auth'], function(){
  Route::get('dashboard', function () {
      return view('welcome');
  });


  Route::get('logout', 'Auth\LoginController@logout')->name('logout');


  //group
  Route::get('groups', 'UserGroupsController@index');
  Route::get('groups/create', 'UserGroupsController@create');
  Route::post('groups', 'UserGroupsController@store');
  Route::delete('groups/{id}', 'UserGroupsController@destroy');


  //user
  Route::resource('users', 'UsersController');



  Route::get('users/{id}/sales', 'UserSalesController@index')->name('user.sales');
  Route::delete('users/{id}/invoice/{invoice_id}', 'UserSalesController@invoice_destroy')->name('user.sales.destroy');
  Route::post('users/{id}/invoices', 'UserSalesController@createInvoice')->name('user.sales.store');
  Route::get('users/{id}/invoices/{invoice_id}', 'UserSalesController@invoice')->name('user.sales.invoice_details');
  Route::post('users/{id}/invoices/{invoice_id}', 'UserSalesController@addItem')->name('user.sales.invoices.add_item');
  Route::delete('users/{id}/invoices/{invoice_id}/{item_id}', 'UserSalesController@destroy')->name('user.sales.invoices.delete_item');


///purchase route
  Route::get('users/{id}/purchases',                             'UserPurchasesController@index')->name('user.purchases');
  Route::delete('users/{id}/purchase/{invoice_id}',             'UserPurchasesController@purchase_destroy')->name('user.purchases.destroy');
  Route::post('users/{id}/purchases',                            'UserPurchasesController@createInvoice')->name('user.purchases.store');
  Route::get('users/{id}/purchases/{invoice_id}',               'UserPurchasesController@invoice')->name('user.purchases.invoice_details');
  Route::post('users/{id}/purchases/{invoice_id}',              'UserPurchasesController@addItem')->name('user.purchases.add_item');
  Route::delete('users/{id}/purchases/{invoice_id}/{item_id}',  'UserPurchasesController@destroy_items')->name('user.purchases.delete_item');




  Route::get('users/{id}/payments', 'UserPaymentsController@index')->name('user.payments');
  Route::post('users/{id}/payments/{invoice_id?}', 'UserPaymentsController@store')->name('user.payments.store');
  Route::delete('users/{id}/payments/{payment_id}', 'UserPaymentsController@destroy')->name('user.payments.destroy');


  Route::get('users/{id}/receipts', 'UserReceiptsController@index')->name('user.receipts');
  Route::post('users/{id}/receipts/{invoice_id?}', 'UserReceiptsController@store')->name('user.receipts.store');
  Route::delete('users/{id}/receipts/{receipt_id}', 'UserReceiptsController@destroy')->name('user.receipts.destroy');


  //Category
  Route::resource('categories', 'CategoriesController',['except' => ['show']]);

  //products

  Route::resource('products', 'ProductsController');
  Route::get('stocks', 'ProductsStockController@index')->name('stocks');



  Route::get('reports/sales', 'Reports\SaleReportController@index')->name('reports.sales');
});
