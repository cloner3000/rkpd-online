<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePemdaPost extends FormRequest
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
            'nama'                  => 'required|string|max:255',
            'ibu_kota'              => 'required|string|max:255',
            'alamat'                => 'required|string|max:255',
            'nama_kepala_daerah'    => 'required|string|max:255',
            'jabatan_kepala_daerah' => 'required|string|max:255',
            'nama_sekda'            => 'required|string|max:255',
            'nip_sekda'             => 'required|numeric',
            'jabatan_sekda'         => 'required|string|max:255',
            'visi_id'               => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'visi_id' => 'Visi',
        ];
    }
}
