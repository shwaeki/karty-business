<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Category;
use App\Models\City;
use App\Models\Font;
use App\Models\Icon;
use App\Models\Like;
use App\Models\Payment;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function optimize()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('optimize');
        return '<h1>optimize  done</h1>';
    }


    public function sitemap()
    {
        return Redirect::to('sitemap.xml');
    }

    public function index()
    {
        $data = [
//            'cards' => Card::with('images')->where('published', 1)->take(6)->get(),
            'categories' => Category::all(),

        ];
        return view('home.index', $data);
    }

    public function profile()
    {

        //  dd(request()->all());
        if (request('order')) {
            $message = request('data_message');
            if (request('success')) {
                $order = request('order');
                $payment = Payment::where('payment_id', $order)->firstOrFail();
                $payment->Order->update(['status' => 'Preparation']);
                $payment->update(['payment_status' => 'Paid']);
            }
            session()->flash('massage', $message);
            return Redirect::route('profile');
        }


        $data = [
            'orders' => Auth::user()->Orders()->latest()->get(),
            'cities' => City::all(),
        ];
        return view('home.profile', $data);
    }

    public function checkout($id)
    {


        $card = Card::findOrFail($id);
        $like = $card->Likes()->whereUser(Auth::id())->firstOrFail();

        $data = [
            'card' => $card,
        ];


        return view('home.checkout', $data);
    }


    public function favorite()
    {
        $data = [
            'likes' => Auth::user()->Likes()->where('loved', true)->get(),
            'designs' => Auth::user()->Likes()->where('html', '!=', null)->get(),
        ];
        return view('home.favorite', $data);
    }


    public function design($id)
    {
        $card = Card::findOrFail($id);
        $fonts = Font::all();
        $icons = Icon::all();
        $like = $card->Likes()->whereUser(Auth::id())->first();

        $data = [
            'card' => $card,
            'fonts' => $fonts,
            'icons' => $icons,
            'like' => $like,

        ];
        return view('home.design', $data);
    }

    public function product($id)
    {
        $card = Card::findOrFail($id);
        $seemore = Card::with('images')
            ->where('category', $card->category)
            ->inRandomOrder()->get()->take(3)->except($id);

        $data = [
            'card' => $card,
            'seemore' => $seemore,
        ];
        return view('home.product', $data);
    }

    public function shop()
    {
        $data = [
            'card_count' => Card::all()->count(),
            'max_price' => Card::max('price'),
            'min_price' => Card::min('price'),
        ];

        return view('home.shop', $data);
    }


    public function search()
    {
        $search = request('search');
        $cards = Card::where(function ($query) use ($search) {
            $query->where('published', '1');
            $query->where('name', 'LIKE', "%$search%")->OrWhere('description', 'LIKE', "%$search%");
            $query->orWhereHas('Category', function ($query) use ($search) {
                $query->where('name','LIKE', "%$search%");
            });
        })->get();

        $data = [
            'cards' => $cards,
            'search' => $search,
        ];

        return view('home.search', $data);
    }


    public function saveCardDesign($id)
    {
        $card = Card::findOrFail($id);

        if ($card->Likes()->whereUser(Auth::id())->count() == 0) {
            $like = new Like();
            $like->user = Auth::id();
            $like->html = request('HtmlContent');
            $like->loved = false;
            $like->card = $id;
            $like->save();
        } else {
            $like = $card->Likes()->whereUser(Auth::id())->firstOrFail();
            $like->html = request('HtmlContent');
            $like->save();
        }

        if (request('buy'))
            return redirect()->route('checkout', ['id' => $card]);
        else
            return redirect()->route('favorite');
    }

}
