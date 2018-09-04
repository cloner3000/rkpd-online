<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanPost extends FormRequest
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
        return [
            'nama' => 'required|string|max:255',
            'kode' => 'required|numeric|digits_between:1,2',
            'deskripsi' => 'required|string|max:255',
            'keyword' => 'required|string|max:255',
            'program' => 'required',
            'indikator_sasaran' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'program' => 'Program',
            'indikator_sasaran' => 'Indikator Sasaran',
        ];
    }

    public function messages()
    {
        return [
            'kode.digits' => 'Isian kode harus berukuran 4 angka.',
        ];
    }
}
