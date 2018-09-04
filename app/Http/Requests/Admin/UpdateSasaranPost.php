<?php

namespace App\Http\Requests\Admin;

use App\Admin\Sasaran;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSasaranPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Sasaran::find($this->route('misi'));

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
            'nama'    => 'required|string|max:255',
            'tujuan_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'tujuan_id' => 'Tujuan',
        ];
    }
}