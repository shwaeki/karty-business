<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardStyle;
use App\Models\Category;
use App\Models\Font;
use App\Models\Icon;
use Illuminate\Http\Request;

class CardStylesController extends Controller
{

    public function create(Card  $card)
    {
        $data = [
            'card' => $card,
            'fonts' => Font::all(),
            'icons' => Icon::all(),

        ];
        return view('admin.cards.design', $data);
    }


    public function store(Request $request,Card  $card)
    {
        //
    }


    public function show(CardStyle  $cardStyle)
    {
        //
    }


    public function edit(CardStyle  $cardStyle)
    {
        //
    }


    public function update(Request $request, CardStyle  $cardStyle)
    {
        //
    }


    public function destroy(CardStyle  $cardStyle)
    {
        $cardStyle->delete();
        session()->flash('massage', 'تم حذف التصميم بنجاح');
        return redirect()->back();
    }
}
