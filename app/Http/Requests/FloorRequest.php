<?php

namespace App\Http\Requests;

/**
 * Class FloorRequest
 * @package App\Http\Requests
 */
class FloorRequest extends Request
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
        $fileSize = 0;
        if (ini_get('post_max_size') > ini_get('upload_max_filesize')) {
            $fileSize = $this->convertSize(ini_get('upload_max_filesize'));
        } else {
            $fileSize = $this->convertSize(ini_get('post_max_size'));
        }
        $validation = [];
        if (in_array($this->method(), ['POST', 'PUT'])) {
            $request = $this->request->all();
            if ($request['image-switch'] == 'image_url') {
                $validation = [
                    'name' => 'required',
                    'image_file' => 'mimes:jpeg,bmp,png,gif|max:' . $fileSize,
                    'image_url' => 'required|url',
                ];
            } elseif ($request['image-switch'] == 'image_file') {
                $validation = [
                    'name' => 'required',
                    'image_file' => 'required|mimes:jpeg,bmp,png,gif|max:' . $fileSize,
                    'image_url' => 'url',
                ];
            } else {
                $validation = [
                    'name' => 'required',
                    'image_file' => 'required|mimes:jpeg,bmp,png,gif|max:' . $fileSize,
                    'image_url' => 'required|url',
                ];
            }
        }

        return $validation;
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
            case 'k':
                $value *= 1024;
        }

        return $value / 1024;
    }

}
