<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Multiples50 implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {

        return $value % 50 === 0;
    }


    public function message()
    {
        return 'يجب ان يكون عدد الكروت المطلوبة من مضاعفات العدد 50.';

    }
}
