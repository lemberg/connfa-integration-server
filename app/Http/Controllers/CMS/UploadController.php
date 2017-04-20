<?php

namespace App\Http\Controllers\CMS;

use App\Helpers\ImageHelper;
use App\Http\Requests\UploadImageRequest;
use App\Http\Controllers\Controller;

/**
 * Class UploadController
 * @package App\Http\Controllers\CMS
 */
class UploadController extends Controller
{
    /**
     * @var UploadImageRequest
     */
    private $request;

    /**
     * UploadController constructor.
     * @param UploadImageRequest $request
     */
    public function __construct(UploadImageRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Upload image
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function image()
    {
        if (!$this->request->hasFile('upload')) {
            return response('Could not save image');
        }
        if ($this->request->hasFile('upload')) {
            $path = ImageHelper::saveImage($this->request->file('upload'), 'editor', ['width' => 1800, 'height' => 1800]);
            if (!$path) {
                return response('Could not save image');
            }
        }

        return view('upload.file', [
            'id' => $this->request->query('CKEditorFuncNum'),
            'path' => $path,
            'message' => ''
        ]);
    }

}
