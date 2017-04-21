<?php

namespace App\Http\Requests;

/**
 * Class PageRequest
 * @package App\Http\Requests
 */
class PageRequest extends Request
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
                'name' => 'required|unique:pages,name,NULL,id,deleted_at,NULL',
                'alias' => 'required|unique:pages,alias,NULL,id,deleted_at,NULL',
                'content' => 'required',
            ];
        } elseif ($this->method() == 'PUT') {
            $validation = [
                'name' => 'required|unique:pages,name,' . $this->route()->parameter('id') . ',id,deleted_at,NULL',
                'alias' => 'required|unique:pages,alias,' . $this->route()->parameter('id') . ',id,deleted_at,NULL',
                'content' => 'required',
            ];
        }

        return $validation;
    }
}
