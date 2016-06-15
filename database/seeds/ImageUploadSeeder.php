<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

class ImageUploadSeeder extends Seeder
{
    /**
     * @var Faker
     */
    private $faker;

    /**
     * ImageUploadSeeder constructor.
     *
     * @param Faker $faker
     */
    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Check image in the folder.
     *
     * @return void
     */
    public function run()
    {
        $this->uploadImages();
    }

    /**
     * Upload image to folder use faker
     *
     * @param int $countImages
     * @param string $path
     *
     * @return array
     */
    protected function uploadImages($countImages = 15, $path = 'uploads/fakers')
    {
        $path = public_path($path);
        $images = [];
        if ($this->checkAndMakeDirectory($path)) {
            for ($i = 0; $i < $countImages; $i++) {
                $images[$i] = $this->faker->image($path, 200, 200);
            }
        }

        return $images;
    }

    /**
     * Check directory, if not exist then create it
     *
     * @param $path
     *
     * @return bool
     */
    protected function checkAndMakeDirectory($path)
    {
        if (!File::exists($path)) {
            return File::makeDirectory($path, 0775, true);
        }

        return true;
    }
}