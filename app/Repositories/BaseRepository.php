<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class BaseRepository extends Repository implements RepositoryInterface
{
    public $errors;

    public function model()
    {
    }

    public function findOrFail($id, $columns = ['*'])
    {
        $found = $this->find($id, $columns);

        if (!$found) {
            throw new NotFoundHttpException;
        }

        return $found;
    }

    public function firstOrNew($params)
    {
        return $this->model->firstOrNew($params);
    }

    /**
     * @param Carbon $since date from If-Modified-Since header
     * @param array $params
     *
     * @return bool
     */
    public function checkLastUpdate($since, $params = [])
    {
        $data = $this->model;

        if ($since) {
            $data = $data->where('updated_at', '>=', $since->toDateTimeString());
        }

        if ($params) {
            $data = $data->where($params);
        }

        $data = $data->first();

        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Resize and Save image
     *
     * @param $image
     * @param string $directory
     * @param array $size
     *
     * @return string
     */
    public function saveImage($image, $directory = '', $size = ['width' => 800, 'height' => 600])
    {
        try {
            $imageRealPath = $image->getRealPath();
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $thumbName = $timestamp . '-' . $image->getClientOriginalName();

            $img = Image::make($imageRealPath);
            if ($img->width() > $size['width']) {
                $img->resize(intval($size['width']), null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } elseif ($img->height() > $size['height']) {
                $img->resize(null, intval($size['height']), function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $path = 'uploads' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $thumbName;
            $img->save(public_path() . DIRECTORY_SEPARATOR . $path);

            return $path;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteImage($path)
    {
        $path = public_path() . DIRECTORY_SEPARATOR . $path;
        return File::delete($path);
    }
}
