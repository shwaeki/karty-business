<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Like;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserCardController extends Controller
{
    public function changeUserInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);


        $user = Auth::user();
        $user->name = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->address = request('address');
        $user->city = request('city');
        if (request('password'))
            $user->password = Hash::make(request('password'));
        $user->save();

        $request->session()->flash('massage', 'تم تعديل البيانات  بنجاح');
        return redirect()->route('profile');
    }

    function ajaxLike(Request $request)
    {
        $status = "";
        if ($request->ajax()) {
            $id = request('id');
            $card = Card::findOrFail($id);

            if ($card->Likes()->whereUser(Auth::id())->count() == 0) {
                $like = new Like();
                $like->user = Auth::id();
                $like->card = $id;
                $like->loved = true;
                $like->save();
                $status = "add";
            } else {
                $like = $card->Likes()->whereUser(Auth::id())->first();
                if ($like->loved == false) {
                    $like->loved = true;
                    $status = "add";
                    $like->save();
                }elseif ($like->loved == true && $like->html != null) {
                    $like->loved = false;
                    $like->save();
                    $status = "remove";
                } else {
                    $like->delete();
                    $status = "remove";
                }

            }
        }
        return response()->json([
            'Pstatus' => $status,
            'FCOunt' => Auth::user()->Likes()->count(),
        ], 200);
    }


    public function like($id)
    {
        $card = Card::findOrFail($id);

        if ($card->Likes()->whereUser(Auth::id())->count() == 0) {
            $like = new Like();
            $like->loved = true;
            $like->user = Auth::id();
            $like->card = $id;
            $like->save();
        } else {
            $like = $card->Likes()->whereUser(Auth::id())->first();
            if ($like->loved == false) {
                $like->loved = true;
            }
        }

        return redirect()->back();
    }

    public function removeLike($id, $type = 'loved')
    {
        $card = Card::findOrFail($id);
        if ($card->Likes()->whereUser(Auth::id())->count() > 0) {
            $like = $card->Likes()->whereUser(Auth::id())->first();
            if ($type === 'loved') {
//                dd(2);
                $like->loved = false;
                $like->save();
            } elseif ($type === 'html') {
//                dd(3);
                $like->html = null;
                $like->save();
            }
            if ($like->loved == false && $like->html == null) {
                $like->delete();
//                dd(4);
            }

        }
        return redirect()->back();
    }

    public function removeOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status == 'Pending' || $order->status == 'Preparation') {
            $payment = $order->payment;
            if ($payment && $payment->payment_status != "Paid") {
                if ($order->user == Auth::id()) {

                    if ($payment->payment_method == 'JawwalPay') {
                        $payment_id = $payment->payment_id;

                        $response = Http::post('https://accept.paymobsolutions.com/api/auth/tokens', [
                            'username' => 'ikilane',
                            'password' => 'IKilane22@@',
                        ]);

                        $token = $response['token'];
                        $response1 = Http::withToken($token)->delete('https://accept.paymobsolutions.com/api/ecommerce/orders/' . $payment_id);

                    }

                    $order->delete();
                }
            }
        }
        session()->flash('massage', 'تم حذف هذا الطلب بنجاح');
        return redirect()->back();
    }


    public function removeAllLikes()
    {
        Auth::user()->Likes()->delete();
        return redirect()->back();
    }
}
