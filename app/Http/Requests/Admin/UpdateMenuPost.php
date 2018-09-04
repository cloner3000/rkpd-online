<?php

namespace App\Http\Requests\Admin;

use App\Admin\Menu;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = User::find($this->route('user'));

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
        $item = Menu::find($this->route('menu'));

        return [
            'nama'     => 'required|string|max:255',
            'urutan'    => 'unique:menu,urutan,'.$item->id,
            'url'       => 'required|max:255',
            'level'     => 'required'
        ];
    }
}
