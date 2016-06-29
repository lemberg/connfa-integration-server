<?php

namespace App\Http\Requests;

/**
 * Class SettingRequest
 * @package App\Http\Requests
 */
class SettingRequest extends Request
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
                'timezone' => 'required',
                'twitterSearchQuery' => 'required',
            ];
        }

        return $validation;
    }
}
