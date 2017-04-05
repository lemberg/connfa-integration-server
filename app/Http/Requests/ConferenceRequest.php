<?php

namespace App\Http\Requests;

/**
 * Class ConferenceRequest
 * @package App\Http\Requests
 */
class ConferenceRequest extends Request
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
        if ($this->method() == 'POST') {
            $validation = [
                'name'  => 'required|max:100',
                'alias' => 'required|max:100|unique:conferences,alias,NULL,id,deleted_at,NULL'
            ];
        } elseif ($this->method() == 'PUT') {
            $validation = [
                'name'  => 'required|max:100',
                'alias' => 'required|max:100|unique:conferences,alias,' . $this->route()->parameter('id') . ',id,deleted_at,NULL'
            ];
        }

        return $validation;
    }
}
