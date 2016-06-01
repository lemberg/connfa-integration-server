<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Hash;

class UserRequest extends Request
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
        if ($this->method() == "POST") {
            $validation = [
                'name' => 'required|unique:users',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ];
        } elseif ($this->method() == "PUT") {
            if ($this->request->get('change_password') == true) {
                $validation = [
                    'name' => 'required|unique:users,name,' . $this->route()->parameters()['users'] . ',id',
                    'email' => 'required|unique:users,email,' . $this->route()->parameters()['users'] . ',id|email',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                ];
            } else {
                $validation = [
                    'name' => 'required|unique:users,name,' . $this->route()->parameters()['users'] . ',id',
                    'email' => 'required|unique:users,email,' . $this->route()->parameters()['users'] . ',id|email',
                ];
            }
        }

        return $validation;
    }
}
