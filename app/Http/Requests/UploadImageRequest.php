<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

/**
 * Class UploadImageRequest
 * @package App\Http\Requests
 */
class UploadImageRequest extends Request
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
        return [
            'upload' => 'required|mimes:jpeg,bmp,png,gif|max:4000',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function response(array $errors)
    {
        $message = '';
        foreach ($errors as $data) {
            $message = implode($data, ', ');
        }

        $view = View::make('upload.file', [
            'id' => $this->query('CKEditorFuncNum'),
            'path' => '',
            'message' => $message
        ]);

        return new Response($view, 422);
    }

}
