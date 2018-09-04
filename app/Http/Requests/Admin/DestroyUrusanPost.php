<?php

namespace App\Http\Requests\Admin;

use App\Urusan;
use Illuminate\Foundation\Http\FormRequest;

class DestroyUrusanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Urusan::find($this->route('urusan'));

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
