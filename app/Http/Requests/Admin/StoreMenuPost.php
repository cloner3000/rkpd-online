<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!auth()->user()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $item = $this->request->get('urutan');
        return [
            'nama'      => 'required|max:255',
            'url'       => 'required|max:255',
            'urutan'    => 'unique:menu',
            'level'     => 'required'
        ];
    }
}
