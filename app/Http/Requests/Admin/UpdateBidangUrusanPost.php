<?php

namespace App\Http\Requests\Admin;

use App\BidangUrusan;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBidangUrusanPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = BidangUrusan::find($this->route('bidang_urusan'));

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
            'urusan' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'urusan' => 'Urusan',
        ];
    }

    public function messages()
    {
        return [
            'kode.digits' => 'Isian kode harus berukuran 2 angka.',
        ];
    }
}
