<?php

namespace NpTS\Domain\Client\Requests;

use NpTS\Http\Requests\Request;

class ChangePersonalDataRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  =>  ['required','min:3','max:36']
        ];
    }

    public function messages()
    {
        return [
            //...
        ];
    }
}
