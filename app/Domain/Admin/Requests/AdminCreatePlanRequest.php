<?php

namespace NpTS\Domain\Admin\Requests;

use NpTS\Http\Requests\Request;

class AdminCreatePlanRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @todo Police Create Plan.
         */
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
            'name'      =>  ['required' , 'min:3', 'max:20' , 'unique:Plans'],
            'slots'     =>  ['required' , 'int'],
            'price'     =>  ['required' , 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'     =>  'Você deve inserir um nome para o plano!',
            'name.min'          =>  'O nome do plano deve conter mínimo 3 caracteres.',
            'name.max'          =>  'O nome do plano deve conter no máximo 20 caracteres',
            'name.unique'       =>  'Um plano com esse nome já existe, escolha outro.',


            'slots.required'    =>  'Você deve inserir uma quantidade de slots!',
            'slots.int'         =>  'A quantidade de slots deve ser um número!',

            'price.required'    =>  'Você deve inserir um preço!',
            'price.numeric'     =>  "O preço deve ser um número!",
        ];
    }
}
