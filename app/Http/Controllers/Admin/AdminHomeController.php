<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Card;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function auth;
use function redirect;
use function request;
use function today;
use function view;

class AdminHomeController extends Controller
{

    public function index()
    {
        if (auth('admin')->user()->isPrinter()) {
            return redirect()->route('orders.index', ['page' => 'Printing']);
        }
        if (auth('admin')->user()->isDelivery()) {
            return redirect()->route('orders.index', ['page' => 'Delivering']);
        }

        $moneyStatistics = Order::select(DB::raw('created_at'),
            DB::raw('sum(profit) as total'), DB::raw('count(id) as ordars'))
            ->groupBy(DB::raw('YEAR(created_at)'))->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('created_at', 'asc')->take(12)->get();

        $data = [
            'moneyStatistics' => $moneyStatistics,
            'admins_count' => Admin::count(),
            'cards_count' => Card::count(),
            'orders_count' => Order::count(),
            'users_count' => User::count(),
            'categories_count' => Category::count(),
            'today_users_count' => User::whereDate('created_at', today())->count(),
            'today_orders_count' => Order::whereDate('created_at', today())->count(),
            'today_profits' => Order::whereDate('created_at', today())->sum('cost'),
            'today_net_profits' => Order::whereDate('created_at', today())->sum('profit'),
            'preparation_orders' => Order::where('status', 'Preparation')->orderBY('created_at', 'DESC')->take(5)->get(),
            'printing_orders' => Order::where('status', 'Printing')->orderBY('created_at', 'DESC')->take(6)->get(),
        ];
//        dd($data);
        return view('admin.index', $data);
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);


        if ((Hash::check($request->get('current_password'), auth('admin')->user()->password))) {
            if (strcmp($request->get('current_password'), request('password')) != 0) {

                $user = auth('admin')->user();
                $user->password = Hash::make(request('password'));
                $user->save();
                $request->session()->flash("massage", "تم تغير كلمة المرور بنجاح");
            } else {
                return redirect()->route('settings')->withErrors(["current_password" => "لا يمكن ان تكون كلمة المرور الجديدة مطابقة لكمة المرور الحالية"]);
            }
        } else {
            return redirect()->route('settings')->withErrors(["password" => "كلمة المرور الحالية غير صحيحة"]);
        }

        return redirect()->route('settings');
    }


    public function changeInfo(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . auth('admin')->user()->id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . auth('admin')->user()->id,
            'phone' => 'required',
        ]);


        $user = auth('admin')->user();
        $user->name = request('name');
        $user->username = request('username');
        $user->phone = request('phone');
        $user->email = request('email');
        $user->save();

        $request->session()->flash('massage', 'تم تعديل بياناتك بنجاح');
        return redirect()->route('settings');
    }
}
