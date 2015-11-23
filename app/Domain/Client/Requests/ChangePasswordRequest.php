<?php

namespace NpTS\Domain\Client\Requests;

use NpTS\Http\Requests\Request;


class ChangePasswordRequest extends Request
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
            'password' => ['required','min:6','confirmed','different:current_password'],
            'current_password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            //...
        ];
    }
}
