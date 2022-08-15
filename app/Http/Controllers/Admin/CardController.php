<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardImage;
use App\Models\CardStyle;
use App\Models\Category;
use App\Models\Font;
use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function public_path;
use function redirect;
use function request;
use function session;
use function view;

class CardController extends Controller
{

    public function index()
    {

        $search = request('search') ? request('search') : null;
        if (isset($search) && $search != null)
            $cards = Card::where('name', 'LIKE', "%$search%")->latest()->paginate(15);
        else
            $cards = Card::latest()->paginate(15);

        $data = [
            'cards' => $cards,

        ];
        return view('admin.cards.index', $data);
    }

    public function show(Card $card)
    {

        $data = [
            'product' => $card,

        ];
        return view('admin.cards.show', $data);
    }

    public function create()
    {
        $data = [
            'categories' => Category::all(),

        ];
        return view('admin.cards.create', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cards',
            'cardImages[]' => 'image|mimes:jpg,jpeg,png',
            'cardBorder' => 'required|image|mimes:jpg,jpeg,png',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'minimum' => 'required|numeric',
            'description' => 'nullable|string',
            'discount' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'width' => 'nullable|numeric',

        ]);


        $img = request('cardBorder');
        $imageName = Str::random(10) . '_' . time() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('/images/cards/'), $imageName);


        $card = new Card();
        $card->name = request('name');
        $card->price = request('price');
        $card->cost = request('cost');
        $card->description = request('description');
        $card->discount = request('discount');
        $card->height = request('height');
        $card->width = request('width');
        $card->minimum = request('minimum');
        $card->path = $imageName;
        $card->category = request('category');
        $card->published = false;
        $card->save();

        if ($request->hasFile('cardImages')) {
            $images = request('cardImages');
            foreach ($images as $img) {
                $imageName = Str::random(10) . '_' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('/images/cards/'), $imageName);
                $Image = new CardImage();
                $Image->card = $card->id;
                $Image->path = $imageName;
                $Image->save();

            }
        }

        session()->flash('massage', 'تمت الاضافة بنجاح');
        return redirect()->route('cards.index');
    }


    public function edit(Card $card)
    {
        $data = [
            'card' => $card->load('styles'),
            'fonts' => Font::all(),
            'icons' => Icon::all(),
            'categories' => Category::all(),

        ];
        return view('admin.cards.edit', $data);
    }


    public function update(Request $request, Card $card)
    {
        if (request('publish') != null) {
            $card->published = request('publish');
            $card->save();
            session()->flash('massage', 'تم تعديل حالة الكرت بنجاح');
            return redirect()->route('cards.index');
        }

        $request->validate([
            'name' => 'required|unique:cards,name,' . $card->id,
            'cardBorder' => 'sometimes|nullable|image|mimes:jpg,jpeg,png',
            'description' => 'required|string',
            'cardPrice' => 'required|numeric',
            'cost' => 'required|numeric',
            'discount' => 'required|numeric',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'minimum' => 'required|numeric',
            'category' => 'required|numeric',
        ]);


        if (request('cardBorder')) {
            $img = request('cardBorder');
            $imageName = $card->path;
            $img->move(public_path('/images/cards/'), $imageName);
        }


        $card->name = request('name');
        $card->price = request('cardPrice');
        $card->cost = request('cost');
        $card->description = trim(request('description'));
        $card->discount = request('discount');
        $card->transparent = request()->has('transparent');
        $card->height = request('height');
        $card->width = request('width');
        $card->maxpar = request('maxpar');
        $card->category = request('category');
        $card->save();


        session()->flash('massage', 'تم تعديل الكرت بنجاح');
        return redirect()->route('cards.index');
    }

    public function destroy(Card $card)
    {
        if (File::exists(public_path('/images/cards/' . $card->path))) {
            File::delete(public_path('/images/cards/' . $card->path));
        }

        foreach ($card->images()->get() as $image) {
            if (File::exists(public_path('/images/cards/' . $image->path))) {
                File::delete(public_path('/images/cards/' . $image->path));
            }
        }
        $card->delete();
        session()->flash('massage', 'تم حذف الكرت بنجاح');
        return redirect()->route('cards.index');
    }

    public function destroyImage(CardImage $cardImage)
    {
        $cardImage->delete();
        session()->flash('massage', 'تم حذف الصورة بنجاح');
        return redirect()->back();
    }

}
