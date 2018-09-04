<?php

namespace App\Http\Requests\Admin;

use App\Admin\Tujuan;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTujuanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Tujuan::find($this->route('misi'));

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
            'misi_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'misi_id' => 'Misi',
        ];
    }
}