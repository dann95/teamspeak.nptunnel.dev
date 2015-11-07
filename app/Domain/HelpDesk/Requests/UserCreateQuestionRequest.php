<?php

namespace NpTS\Domain\HelpDesk\Requests;

use NpTS\Http\Requests\Request;

class UserCreateQuestionRequest extends Request
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
            'title' => ['required','min:3','max:20'],
            'body'  =>  ['required','min:3']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Insira um título",
            'title.min' =>  'O título deve ter pelomenos 3 digitos',
            'title.max' =>  'O título só pode ter até 20 digitos',
            'body.required'  =>  'Insira uma mensagem!',
            'body.min'  =>  'A mensagem deve ter pelomenos 3 digitos!'
        ];
    }
}