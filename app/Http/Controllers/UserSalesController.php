<?php

namespace App\Http\Controllers;

use App\SaleInvoice;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Session;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceProductRequest;
use App\User;
use App\Product;
use App\SaleItems;
class UserSalesController extends Controller
{

  public function __construct()
  {
    $this->data['tab_menu'] = 'sales';
  }

  public function index($id)
  {
    $this->data['user'] = User::findOrFail($id);

    return view('users.sales.sales',$this->data);
  }

  public function invoice_destroy($user_id, $invoice_id)
  {
    if (SaleInvoice::destroy($invoice_id)) {
       Session::flash('message', 'Sale deleted Successfully!');
    }

      return redirect()->route('user.sales', ['id' => $user_id]);

  }

  public function createInvoice(InvoiceRequest $request, $user_id)
  {
    //return $request->all();
    $formData = $request->all();
    $formData['user_id'] = $user_id;
    $formData['admin_id'] = Auth::id();
    if (SaleInvoice::create($formData)) {
      Session::flash('message', 'Sale added Successfully!');
    }
    return redirect()->route('user.sales', ['id' => $user_id]);
  }

  public function Invoice($user_id, $invoice_id)
  {
    $this->data['user'] = User::findOrFail($user_id);
    $this->data['invoice'] = SaleInvoice::findOrFail($invoice_id);
    $this->data['products'] = Product::arrayForSelect();
    //return $this->data['invoice']->items;
    return view('users.sales.invoice', $this->data);
  }

  public function addItem(InvoiceProductRequest $request, $user_id , $invoice_id)
  {
     $formData = $request->all();

     $formData['sale_invoice_id'] = $invoice_id;

     if (SaleItems::create($formData)) {
       Session::flash('message', 'Product added Successfully!');
     }
     return redirect()->route('user.sales.invoice_details', ['id' => $user_id , 'invoice_id' =>$invoice_id]);
  }

  public function destroy($user_id , $invoice_id, $item_id)
  {
      if (SaleItems::destroy($item_id)) {
         Session::flash('message', 'Product deleted Successfully!');
      }

        return redirect()->route('user.sales.invoice_details', ['id' => $user_id , 'invoice_id' =>$invoice_id]);
  }

}
