<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{

    public function jawwalPayResponse()
    {
     //   dd(request()->all());
        if (request('order')) {
            if (request('success') == 'true') {
                $order = request('order');
                $payment = Payment::where('payment_id', $order)->firstOrFail();
                $payment->Order->update(['status' => 'Preparation']);
                $payment->update(['payment_status' => 'Paid']);
                session()->flash('massage', 'تمت عملية الدفع بنجاح');
            }else{
                session()->flash('massage', 'حدث خطا ما الرجاء مراجعة المزود والمحاولة مرة اخرى !');
                session()->flash('error', 'error');
            }
            return Redirect::route('profile');
        }
        session()->flash('massage', 'حدث خطا ما الرجاء مراجعة المزود والمحاولة مرة اخرى !');
        session()->flash('error', 'error');
        return Redirect::route('profile');
    }


    public function payPalSuccess(Request $request)
    {

        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($response['INVNUM']) {

                $order = $response['INVNUM'];
                $payment = Payment::where('payment_id', $order)->firstOrFail();

                $product = [];
                $product['items'] = [];
                $product['invoice_id'] = $order;
                $product['invoice_description'] = "Order #{$payment->Order->Card->name} Bill";
                $product['total'] = $payment->Order->cost;

                $response1 = $paypalModule->doExpressCheckoutPayment($product, $request->token, $request->PayerID);
                if (in_array(strtoupper($response1['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                    $payment->Order->update(['status' => 'Preparation']);
                    $payment->update(['payment_status' => 'Paid']);
                    session()->flash('massage', 'تمت عملية الدفع بنجاح');
                    return Redirect::route('profile');
                }
            }
        }
        session()->flash('massage','حدث خطا ما الرجاء المحولة مرة اخرى في وقت لاحق!');
        session()->flash('error', 'error');
        return Redirect::route('profile');
    }

    public function paypalCancel()
    {
        session()->flash('massage', 'تم رفض الدفع الخاص بك.');
        session()->flash('error', 'error');
        return Redirect::route('profile');
    }

}
