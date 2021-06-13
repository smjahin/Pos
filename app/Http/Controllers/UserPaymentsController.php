<?php

namespace App\Http\Controllers;
use App\User;
use App\Payment;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;

class UserPaymentsController extends Controller
{

    public function __construct()
    {
      $this->data['tab_menu'] = 'payments';
    }


    public function index($id)
    {
      $this->data['user'] = User::findOrFail($id);

      return view('users.payments.payments',$this->data);
    }


   public function store(PaymentRequest $request, $user_id , $invoice_id = null)
    {
      $formData = $request->all();
      $formData['user_id'] = $user_id;
      $formData['admin_id'] = Auth::id();
      if ($invoice_id) {
        $formData['purchase_invoice_id'] = $invoice_id;
      }
      if (Payment::create($formData)) {
        Session::flash('message', 'Payment added Successfully!');
      }if ($invoice_id) {
         return redirect()->route('user.purchases.invoice_details', ['id' => $user_id , 'invoice_id' =>$invoice_id]);
      }
      else {
        return redirect()->route('user.payments', ['id' => $user_id]);
      }

    }

    public function destroy($user_id, $payment_id)
    {

      if (Payment::destroy($payment_id)) {
         Session::flash('message', 'User deleted Successfully!');
      }

        return redirect()->route('user.payments', ['id' => $user_id]);
    }


}
