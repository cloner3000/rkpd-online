<?php

namespace App\Http\Requests\Admin;

use App\BidangUrusan;
use Illuminate\Foundation\Http\FormRequest;

class DestroyBidangUrusanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = BidangUrusan::find($this->route('bidang_urusan'));

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
