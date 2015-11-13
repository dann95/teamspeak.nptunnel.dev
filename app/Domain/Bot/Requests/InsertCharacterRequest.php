<?php

namespace NpTS\Domain\Bot\Requests;

use NpTS\Http\Requests\Request;

class InsertCharacterRequest extends Request
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
            'name' => ['required' , 'min:2' , 'max:30']
        ];
    }

    public function messages()
    {
        return [
            // ...
        ];
    }
}
