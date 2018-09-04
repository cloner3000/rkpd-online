<?php

namespace App\Http\Requests\Admin;

use App\Kegiatan;
use Illuminate\Foundation\Http\FormRequest;

class DestroyKegiatanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Kegiatan::find($this->route('kegiatan'));

        if (is_null($item)) {
            abort(404);
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
            //
        ];
    }
}
