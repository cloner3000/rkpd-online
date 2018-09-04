<?php

namespace App\Http\Requests\Admin;

use App\Program;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Program::find($this->route('program'));

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
            'bidang_urusan' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'bidang_urusan' => 'Bidang Urusan',
        ];
    }

    public function messages()
    {
        return [
            'kode.digits' => 'Isian kode harus berukuran 2 angka.',
        ];
    }
}
