<?php

if (!function_exists('get_max_file_size')) {

    function get_max_file_size() {
        $fileUploadSize = convertSize(ini_get('upload_max_filesize'));
        $fileMaxSize = convertSize(ini_get('post_max_size'));

        return $fileMaxSize > $fileUploadSize ? ini_get('upload_max_filesize') : ini_get('post_max_size');
    }

    /**
     * @param string $value
     * @return int
     */
    function convertSize($value)
    {
        $value = trim($value);
        $last = strtolower($value[strlen($value) - 1]);
        switch($last) {
            case 'g':
                $value *= 1024;
            case 'm':
                $value *= 1024;
        }

        return $value;
    }
}