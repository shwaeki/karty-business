<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Order;
use App\Rules\Multiples50;
use App\Services\PaymentServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CheckoutComponent extends Component
{

    public $card;
    public $discount = 0;
    public $quantity = 50;
    public $coupon;
    public $coupon_discount = 0;
    public $coupon_error = false;
    public $deliveryCost = 0;
    public $total;
    public $subtotal;
    public $cities;
    public $city;
    public $payment = 'cash';
    public $address;
    public $notes = "";



    public function mount()
    {
        Log::info('ss');
        $this->city = Auth::user()->city;
        $this->address = Auth::user()->address;
    }

    public function render()
    {

        if (isset($this->city)) {
            $this->deliveryCost = City::findOrFail($this->city)->price;
        }

        $this->subtotal = $this->quantity * $this->card->discount_price;
        $coupon_discount = 0;
        if ($this->coupon_discount && $this->coupon_discount > 0 ) {
          $coupon_discount =   ( $this->coupon_discount/100) *  $this->subtotal;
        }

        $this->total = (  $this->subtotal - $coupon_discount) + $this->deliveryCost;


        $this->cities = City::all();


        return view('livewire.checkout-component');
    }





    public function applyCode()
    {
        if (isset($this->coupon)) {
            $coupon = Coupon::where('code', $this->coupon)->first();
            if ($coupon != null && $coupon->count > 0) {
                $this->coupon_discount = $coupon->percentage;
                $this->coupon_error = false;
            }else {
                $this->coupon_error = true;
                $this->coupon_discount = 0;
            }
        }else {
            $this->coupon_error = true;
            $this->coupon_discount = 0;
        }

    }

    public function checkout()
    {
        Log::info("1");
        $this->validate([
            'address' => ['required'],
            'city' => ['required'],
            'quantity' => ['required', 'numeric', 'min:50', new Multiples50()],
        ]);
        Log::info("11");

        //  dd(request()->all());
        $user = Auth::user();
        $card = $this->card;
        $like = $card->Likes()->whereUser($user->id)->firstOrFail();

        Log::info("2");

        if (!isset($user->address) || empty($user->address))
            $user->address = $this->address;
        if (!isset($user->city) || empty($user->city))
            $user->city = $this->city;
        $user->save();
        Log::info("3");

        $status = 'Preparation';
        if ($this->payment != 'cash') {
            $status = 'Pending';
        }

        Log::info("4");
       if ($this->coupon_discount && $this->coupon_discount > 0 ) {
            $coupon = Coupon::where('code', $this->coupon)->first();
            $coupon->decrement('count');
        }


        Log::info("5");
        //dd($total);
        $htmlContent = $like->html;
        $order = new Order();
        $order->html = $htmlContent;
        $order->card = $this->card->id;
        $order->user = $user->id;
        $order->cost = $this->total;
        $order->profit = $this->quantity * $this->card->cost;
        $order->quantity = $this->quantity;
        $order->notes = $this->notes;
        $order->status = $status;
/*        if ($card->transparent == true) {
            $order->transparent = request()->has('transparent');
        }*/

        $order->save();
      //  $like->delete();
        Log::info('payment   '.$this->payment);


        if ($this->payment === 'paypal') {
            $url = (new PaymentServices())->payPal($order);
        } elseif ($this->payment === 'jawwalpay') {
            $url = (new PaymentServices())->jawwalpay($order);
        }else{
            $url = (new PaymentServices())->cash($order);
        }
        Log::info($url);
        return Redirect::to($url);
    }
}
