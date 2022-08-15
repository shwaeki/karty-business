<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Font;
use App\Models\Icon;
use App\Models\Order;
use Illuminate\Http\Request;
use function abort;
use function auth;
use function redirect;
use function request;
use function response;
use function session;
use function view;

class OrderController extends Controller
{
    public function index($page)
    {
        $User = auth('admin')->user();
        if (!$User->isAdmin()) {
            if (!$User->isDelivery() && $page == "Delivering" ) {
                return abort(403, 'Unauthorized action.');
            }
            if (!$User->isPrinter() && $page == "Printing" ) {
                return abort(403, 'Unauthorized action.');
            }
        }
        $data = [
            'orders' => Order::where('status', $page)->orderBY('created_at', 'DESC')->simplePaginate(15),
        ];
        return view('admin.orders.index', $data);
    }


    public function show(Order $order)
    {
        $data = [
            'order' => $order,
            'fonts' => Font::all(),
        ];
        return view('admin.orders.show', $data);
    }


    public function edit(Order $order)
    {
        $data = [
            'order' => $order,
            'fonts' => Font::all(),
            'icons' => Icon::all(),

        ];
        return view('admin.orders.edit', $data);
    }


    public function update(Request $request, Order $order)
    {
        if (request('HtmlContent')) {
            $order->html = request('HtmlContent');
        } else {
            $order->status = request('status');
        }

        $order->save();

        session()->flash('massage', 'تم تعديل الكرت بنجاح');
        return redirect()->route('orders.index',['page'=>'Preparation']);
    }


    public function checkCount($usertype)
    {
        $orders = Order::count();
        if ($usertype == 'Printer') {
            $orders = Order::where('status','Printing')->count();
        }elseif ($usertype == 'Delivery') {
            $orders = Order::where('status','Delivering')->count();
        }
        return response()->json([
            'count' => $orders,
        ], 200);
    }

    public function destroy(Order $order)
    {

    }
}
