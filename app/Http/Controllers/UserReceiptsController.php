<?php

namespace App\Http\Controllers;
use App\User;
use App\Receipt;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\ReceiptRequest;

class UserReceiptsController extends Controller
{
  public function __construct()
  {
    $this->data['tab_menu'] = 'receipts';
  }
  public function index($id)
  {
    $this->data['user'] = User::findOrFail($id);

    return view('users.receipts.receipts',$this->data);
  }

  public function store(ReceiptRequest $request, $user_id , $invoice_id = null)
   {

     $formData = $request->all();
     $formData['user_id'] = $user_id;
     $formData['admin_id'] = Auth::id();
     if ($invoice_id) {
       $formData['sale_invoice_id'] = $invoice_id;
     }
     if (Receipt::create($formData)) {
       Session::flash('message', 'Receipt added Successfully!');
     }
     if ($invoice_id) {
        return redirect()->route('user.sales.invoice_details', ['id' => $user_id , 'invoice_id' =>$invoice_id]);
     }
     else {
       return redirect()->route('user.receipts', ['id' => $user_id]);
     }

   }

   public function destroy($user_id, $receipt_id)
   {

     if (Receipt::destroy($receipt_id)) {
        Session::flash('message', 'User deleted Successfully!');
     }

       return redirect()->route('user.receipts', ['id' => $user_id]);
   }

}
