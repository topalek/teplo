<?php

namespace App\Http\Requests;

class UpdateParamRequest
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
