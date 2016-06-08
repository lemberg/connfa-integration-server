<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Mockery\CountValidator\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BaseRepository extends Repository implements RepositoryInterface
{
    public $errors;

    public function model()
    {
    }

    /**
     * Find resource or throw NotFoundHttpException
     *
     * @param $id
     * @param array $columns
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $found = $this->find($id, $columns);

        if (!$found) {
            throw new NotFoundHttpException;
        }

        return $found;
    }

    /**
     * Find first resource or create new
     *
     * @param $params
     * @return mixed
     */
    public function firstOrNew($params)
    {
        return $this->model->firstOrNew($params);
    }

    /**
     * Check if resource was updated since $since param
     *
     * @param Carbon $since date from If-Modified-Since header
     * @param array $params
     *
     * @return bool
     */
    public function checkLastUpdate($since, $params = [])
    {
        $data = $this->model->withTrashed();

        if ($since) {
            $data = $data->where('updated_at', '>=', $since->toDateTimeString());
        }

        if ($params) {
            $data = $data->where($params);
        }

        $data = $data->withTrashed()->first();

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
            $directory = str_replace('.', DIRECTORY_SEPARATOR, $directory);
            $imageRealPath = $image->getRealPath();
            $timestamp = Carbon::now()->format('Y-m-d-H-i-s');
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
            $pathToDirectory = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR;
            if (!$this->checkAndMakeDirectory($pathToDirectory)) {
                throw new FileException(sprintf('Unable to create the "%s" directory', $pathToDirectory));
            }

            $path = $pathToDirectory . $thumbName;
            $img->save(public_path() . $path);

            return $path;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Delete image by path
     *
     * @param string $path
     *
     * @return mixed
     */
    public function deleteImage($path)
    {
        $realPath = public_path($path);
        if (File::exists($realPath)) {
            return File::delete($realPath);
        }

        return true;
    }

    /**
     * Create directory if it don't exist
     *
     * @param string $path
     *
     * @return bool
     */
    protected function checkAndMakeDirectory($path)
    {
        $realPath = public_path($path);
        if (!File::exists($realPath)) {
            return File::makeDirectory($realPath, 0775, true);
        }

        return true;
    }

    /**
     * Find or create
     * 
     * @param array $parameters
     *
     * @return mixed
     */
    public function firstOrCreate(array $parameters)
    {
        return $this->model->firstOrCreate($parameters);
    }
}
