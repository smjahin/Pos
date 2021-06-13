<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Session;
use App\Product;
use App\PurchaseItems;
use App\PurchaseInvoice;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\InvoiceProductRequest;
class UserPurchasesController extends Controller
{
  public function __construct()
  {
    $this->data['tab_menu'] = 'purchases';
  }
  public function index($id)
  {
    $this->data['user'] = User::findOrFail($id);

    return view('users.purchases.purchases',$this->data);
  }



  public function createInvoice(InvoiceRequest $request, $user_id)
  {

    $formData = $request->all();
    $formData['user_id'] = $user_id;
    $formData['admin_id'] = Auth::id();
    if (PurchaseInvoice::create($formData)) {
      Session::flash('message', 'Sale added Successfully!');
    }

    return redirect()->route('user.purchases', ['id' => $user_id]);

  }




  public function invoice($user_id, $invoice_id)
  {
    $this->data['user'] = User::findOrFail($user_id);
    $this->data['invoice'] = PurchaseInvoice::findOrFail($invoice_id);
    $this->data['products'] = Product::arrayForSelect();
    $this->data['totalPayable'] = $this->data['invoice']->items()->sum('total');
    $this->data['totalPaid'] = $this->data['invoice']->payments()->sum('amount');

    //return $this->data['invoice']->items;
    return view('users.purchases.invoice', $this->data);
  }

  public function addItem(InvoiceProductRequest $request, $user_id , $invoice_id)
  {
     $formData = $request->all();

     $formData['purchase_invoice_id'] = $invoice_id;

     if (PurchaseItems::create($formData)) {
       Session::flash('message', 'Product added Successfully!');
     }
     return redirect()->route('user.purchases.invoice_details', ['id' => $user_id , 'invoice_id' =>$invoice_id]);
  }

  public function destroy_items($user_id , $invoice_id, $item_id)
  {
      if (PurchaseItems::destroy($item_id)) {
         Session::flash('message', 'Product deleted Successfully!');
      }

        return redirect()->route('user.purchases.invoice_details', ['id' => $user_id , 'invoice_id' =>$invoice_id]);
  }

  public function purchase_destroy($user_id, $invoice_id)
  {
    if (PurchaseInvoice::destroy($invoice_id)) {
       Session::flash('message', 'Purchase deleted Successfully!');
    }

      return redirect()->route('user.purchases', ['id' => $user_id]);
  }





}
