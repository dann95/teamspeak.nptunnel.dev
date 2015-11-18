<?php

namespace NpTS\Domain\Bot\Requests;

use NpTS\Http\Requests\Request;

class UpdateTibiaSettingsRequest extends Request
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
            'enemy_ch_id'   =>  ['required','int'],
            'friend_ch_id'  =>  ['required','int'],
            'world_id'      =>  ['required','int']
        ];
    }
}
