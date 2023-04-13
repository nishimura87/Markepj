<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile; 

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        // $file = $this->faker->image(storage_path('app/public/news_img'), 500, 500);
        // $path = str_replace('/Applications/MAMP/htdocs/Markepj/storage/app/public/news_img', '/news_img', $file);

        //s3利用の場合
        $file = $this->faker->image(500, 500);
        $image = Storage::disk('s3')->putFile('news_img', $file, 'public');
        $path = Storage::disk('s3')->url($image);

        return [
            'title' => $this->faker->realText(20),
            'body' => $this->faker->realText(50),
            'img_path' => $path
        ];
    }
}
