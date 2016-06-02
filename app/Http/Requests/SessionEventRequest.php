<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SessionEventRequest extends Request
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
                'start_at' => 'required|date_format:Y-m-d H:i:s',
                'end_at' => 'required|date_format:Y-m-d H:i:s',
                'text' => 'required',
                'url' => 'url',
            ];
        }

        return $validation;
    }
}
