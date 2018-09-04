<?php

namespace App\Http\Requests\Admin;

use App\Admin\IndikatorSasaran;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIndikatorSasaranPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = IndikatorSasaran::find($this->route('indikator-sasaran'));

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
            'nama'       => 'required',
            'sasaran_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'sasaran_id' => 'Sasaran',
        ];
    }
}