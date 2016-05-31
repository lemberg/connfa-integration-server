<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocationRequest extends Request
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
                'lat' => 'required|regex:/^([0-9]?[0-9])\.(\d+)$/',
                'lon' => 'required|regex:/^([0-9]?[0-9])\.(\d+)$/',
                'address' => 'required',
            ];
        }

        return $validation;
    }
}
