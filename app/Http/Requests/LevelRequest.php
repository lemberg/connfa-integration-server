<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class LevelRequest
 * @package App\Http\Requests
 */
class LevelRequest extends Request
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
            ];
        }

        return $validation;
    }
}
