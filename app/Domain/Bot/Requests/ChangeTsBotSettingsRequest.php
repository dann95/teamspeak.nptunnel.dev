<?php

namespace NpTS\Domain\Bot\Requests;

use NpTS\Http\Requests\Request;

class ChangeTsBotSettingsRequest extends Request
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
            'tibia_list'    =>  ['required','boolean'],
            'auto_afk'      =>  ['required','boolean'],
            'afk_ch_id'     =>  ['required','int'],
            'max_afk_time'  =>  ['required','int','notin:0'],
        ];
    }
}
