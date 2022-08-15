<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\Category;
use Livewire\Component;


class ShopComponent extends Component
{


    public $numResults = 9;

    public $min_price = "";
    public $max_price = "";
    public $filter = [
        "search" => "",
        "sort" => "default",
        "category" => "default",
        "min" => "",
        "max" => "",
    ];

    public $categories = [];
    protected $listeners = [
        'load-more' => 'loadMore',
    ];


    public function loadMore()
    {
        $this->numResults += 9;
    }


    public function mount($min, $max)
    {
        $this->min_price = $min;
        $this->max_price = $max;
        $this->filter['min'] = abs(((float)$min - ($max/ 2)));
        $this->filter['max'] = $max;
    }

    public function render()
    {

        $this->categories = Category::all();
        $cards = Card::where(function ($query) {
            $query->where('published', '1');

            $search = $this->filter['search'];
            $query->where('name', 'LIKE', "%$search%");

            $category = $this->filter['category'];
            if ($category !== "" && $category !== "default") {
                $query->where('category', $category);
            }

            $min = $this->filter['min'];
            $max = $this->filter['max'];
            if ($min !== "" && $max !== "") {
                $min = abs(((float)$min - ($this->max_price / 2)));
                $query->whereBetween('price', [$min, $max]);
            }


        });
        $sort = $this->filter['sort'];
        if (isset($sort) && $sort !== "default") {
            if ($sort === 'DESC') {
                $cards->orderBY('price', 'DESC');
            } elseif ($sort === 'ASC') {
                $cards->orderBY('price', 'ASC');
            } elseif ($sort === 'newest') {
                $cards->latest();
            }
        }


        $cards = $cards->paginate($this->numResults);

        return view('livewire.shop-component', ['cards' => $cards,]);
    }
}
