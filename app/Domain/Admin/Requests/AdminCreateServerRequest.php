<?php

namespace NpTS\Domain\Admin\Requests;

use NpTS\Http\Requests\Request;

class AdminCreateServerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @todo Police Create Server
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
            'name'          =>  ['required','min:3','max:20','unique:Servers'],
            'ip'            =>  ['required','ip','unique:Servers'],
            'dns'           =>  ['required','active_url:A'],
            'user'          =>  ['required','min:3','max:20'],
            'password'      =>  ['required','min:6','max:40'],
            'max_slots'     =>  ['required','int'],
        ];
    }

    /**
     * Custom Messages For Validation!
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'         =>  'Você deve inserir um nome!',
            'name.min'              =>  'O nome deve conter mínimo 3 digitos',
            'name.max'              =>  'O nome deve conter máximo 20 digitos',
            'name.unique'           =>  'Já existe um server com esse nome',

            'ip.required'           =>  'Você deve inserir o ip do servidor',
            'ip.ip'                 =>  'Insira um ip valido',
            'ip.unique'             =>  'Já existe um server com esse ip',

            'dns.required'          =>  'Insira um dns',
            'dns.active_url'        =>  'Esse não é um dns válido',

            'user.required'         =>  'Insira um usuario do ServerQuery',
            'user.min'              =>  'O usuario deve conter mínimo 3 digitos',
            'user.max'              =>  'O usuario deve conter máximo 20 digitos',

            'password.required'     =>  'Você deve inserir a senha',
            'password.min'          =>  'A senha deve conter mínimo 6 digitos',
            'password.max'          =>  'A senha deve conter máximo 40 digitos',

            'max_slots.required'    =>  'Insira a quantidade de slots',
            'max_slots.int'         =>  'A quantidade de slots deve ser um numero',
        ];
    }
}
