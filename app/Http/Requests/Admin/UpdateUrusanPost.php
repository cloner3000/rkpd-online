<?php

namespace App\Http\Requests\Admin;

use App\Urusan;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUrusanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Urusan::find($this->route('urusan'));

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
            'nama' => 'required|string|max:255',
            'kode' => 'required|numeric|digits_between:1,2',
            'visi' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'visi' => 'Visi',
        ];
    }

    public function messages()
    {
        return [
            'kode.digits' => 'Isian kode harus berukuran 2 angka.',
        ];
    }
}
