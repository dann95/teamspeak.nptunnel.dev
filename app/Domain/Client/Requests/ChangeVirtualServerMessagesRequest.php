<?php

namespace NpTS\Domain\Client\Requests;

use NpTS\Http\Requests\Request;

class ChangeVirtualServerMessagesRequest extends Request
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
            "virtualserver_name"    =>  ['required','min:1'],
            "virtualserver_hostmessage" =>  [],
        ];
    }

    /**
     * Get Custom Messages to Validation!
     * @return array
     */
    public function messages()
    {
        return [
            //"virtualserver_hostmessage.max" =>  'O tamanho máximo para a mensagem do host é de 1024 caracteres',
        ];
    }
}
