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
        $validation = [];
        if (in_array($this->method(), ['POST', 'PUT'])) {
            $request = $this->request->all();
            if ($request['image-switch'] == 'image_url') {
                $validation = [
                    'name' => 'required',
                    'image_file' => 'mimes:jpeg,bmp,png,gif|max:20000',
                    'image_url' => 'required|url',
                ];
            } elseif ($request['image-switch'] == 'image_file') {
                $validation = [
                    'name' => 'required',
                    'image_file' => 'required|mimes:jpeg,bmp,png,gif|max:20000',
                    'image_url' => 'url',
                ];
            } else {
                $validation = [
                    'name' => 'required',
                    'image_file' => 'required|mimes:jpeg,bmp,png,gif|max:20000',
                    'image_url' => 'required|url',
                ];
            }
        }

        return $validation;
    }
}
