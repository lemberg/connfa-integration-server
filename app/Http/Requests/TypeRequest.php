<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation = [];
        if (in_array($this->method(), ['POST', 'PUT'])) {
            $validation = [
                'name' => 'required',
                'icon_file' => 'mimes:jpeg,bmp,png,gif|max:6000',
                'icon_url' => 'url',
            ];
        }

        return $validation;
    }
}
