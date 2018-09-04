<?php

namespace App\Http\Requests\Admin;

use App\Program;
use Illuminate\Foundation\Http\FormRequest;

class DestroyProgramPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Program::find($this->route('program'));

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
