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
        $fileUploadSize = $this->convertSize(ini_get('upload_max_filesize'));
        $fileMaxSize = $this->convertSize(ini_get('post_max_size'));

        $fileSize = $fileMaxSize > $fileUploadSize ? $fileUploadSize : $fileMaxSize;

        $validation = [];
        if (in_array($this->method(), ['POST', 'PUT'])) {
            $validation = [
                'first_name' => 'required',
                'last_name' => 'required',
                'website' => 'url',
                'email' => 'between:3,64|email',
                'avatar_file' => 'mimes:jpeg,bmp,png,gif|max:' . $fileSize,
                'avatar_url' => 'url',
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

    /**
     * @param string $value
     * @return int
     */
    public function convertSize($value)
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value) - 1]);
        switch($last) {
            case 'g':
                $value *= 1024;
            case 'm':
                $value *= 1024;
        }

        return $value;
    }

}
