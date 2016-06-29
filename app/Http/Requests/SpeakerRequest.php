<?php

namespace App\Http\Requests;

/**
 * Class SpeakerRequest
 * @package App\Http\Requests
 */
class SpeakerRequest extends Request
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
                'first_name' => 'required',
                'last_name' => 'required',
                'website' => 'url',
                'email' => 'between:3,64|email',
                'image_file' => 'mimes:jpeg,bmp,png,gif|max:6000',
                'image_url' => 'url',
            ];
        }

        return $validation;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'website.url' => 'Not a valid URL format.',
        ];
    }
}
