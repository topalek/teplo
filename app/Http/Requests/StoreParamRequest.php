<?php

namespace App\Http\Requests;

class StoreParamRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
