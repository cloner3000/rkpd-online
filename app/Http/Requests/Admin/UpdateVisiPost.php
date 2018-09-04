<?php

namespace App\Http\Requests\Admin;

use App\Admin\Visi;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVisiPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Visi::find($this->route('visi'));

        if (!auth()->user() && !empty($item)) {
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
        return [
            'nama'    => 'required|string|max:255|unique:visi,nama,'.$this->route('visi'),
            'mulai'   => 'required|unique:visi,mulai,'.$this->route('visi'),
        ];
    }
}
