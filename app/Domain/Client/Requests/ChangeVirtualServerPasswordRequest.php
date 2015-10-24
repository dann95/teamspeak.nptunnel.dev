<?php

namespace NpTS\Domain\Client\Requests;

use NpTS\Http\Requests\Request;

class ChangeVirtualServerPasswordRequest extends Request
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
            'password'  =>  ['max:32']
        ];
    }

    /**
     * Get the custom messages to the validation.
     * @return array
     */
    public function messages()
    {
        return [
            'password.max'      =>  'O tamanho máximo para a senha é de 32 digitos',
        ];
    }
}
