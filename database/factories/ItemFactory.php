<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $size = array("S" , "M" , "L");
        
        $images = array();
        $randPath = rand(1, 4);
        for ($i = 0; $i <= $randPath; $i++){
            // $file[$i] = $this->faker->image(storage_path('app/public/img'), 500, 500);
            // $path[$i] = str_replace('/Applications/MAMP/htdocs/Markepj/storage/app/public/img', '/img', $file[$i]);

            //s3利用の場合
            $file[$i] = $this->faker->image(NULL,500, 500 ,NULL,false);
            $path[$i] = Storage::disk('s3')->putFile('item_img', $file[$i], 'public');
        }
        for ($i = 0; $i <= 4; $i++){
            if(isset($path[$i])){
                $images[$i] = $path[$i];
            }
            else{
                $images[$i] = null;
            }
        }

        return [
            'category_id' => $this->faker->numberBetween(1,4),
            'title' => $this->faker->realText(10),
            'price' => $this->faker->numberBetween(3000,5000),
            'color' => $this->faker->realText(10),
            'size' => $this->faker->randomElement($size),
            'quantity' => $this->faker->randomNumber(3),
            'part_number' => $this->faker->randomNumber(5),
            'info' => $this->faker->realText(50),
            'material' => $this->faker->realText(10),
            'img_path1' => $images[0],
            'img_path2' => $images[1],
            'img_path3' => $images[2],
            'img_path4' => $images[3],
            'img_path5' => $images[4],
        ];
    }
}
