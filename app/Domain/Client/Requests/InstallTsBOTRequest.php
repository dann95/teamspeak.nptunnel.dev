<?php

namespace NpTS\Domain\Client\Requests;

use NpTS\Http\Requests\Request;

class InstallTsBOTRequest extends Request
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
            'name' => ['required','min:4','max:16'],
            'login' => ['required','min:3','max:32'],
            'password' => ['required','min:1','max:64']
        ];
    }

    public function messages()
    {
        return [
            //...
        ];
    }
}
