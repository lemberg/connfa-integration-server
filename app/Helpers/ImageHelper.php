<?php

namespace App\Helpers;

use App\Exceptions\ResourceException;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class ImageHelper
 * @package App\Helpers
 */
class ImageHelper
{
    /**
     * Resize and Save image
     *
     * @param $image
     * @param string $directory
     * @param array $size
     *
     * @return string
     */
    public static function saveImage($image, $directory = '', $size = ['width' => 800, 'height' => 600])
    {
        try {
            $directory = str_replace('.', DIRECTORY_SEPARATOR, $directory);
            $imageRealPath = $image->getRealPath();
            $timestamp = Carbon::now()->format('Y-m-d-H-i-s');
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $thumbName = $timestamp . '-' . str_slug($fileName, "-") . '.' . $extension;

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
            if (!self::checkAndMakeDirectory($pathToDirectory)) {
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
     * Create directory if it don't exist
     *
     * @param string $path
     *
     * @return bool
     */
    protected static function checkAndMakeDirectory($path)
    {
        $realPath = public_path($path);
        if (!File::exists($realPath)) {
            return File::makeDirectory($realPath, 0775, true);
        }

        return true;
    }
}
