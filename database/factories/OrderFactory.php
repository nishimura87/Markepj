<?php

namespace Database\Factories;

use App\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class OrderFactory extends Factory
{
    public function definition()
    {
        $item = Item::inRandomOrder()->first();

        $fakePostcode = $this->faker->postcode();
        $post1 = substr($fakePostcode ,0,3);
        $post2 = substr($fakePostcode ,3);
        $postcode = $post1 . "-" . $post2;

        $fakeAddress =$this->faker->address();
        $address = substr($fakeAddress, 9);

        return [
            'item_id' => $item->id,
            'price' => $item->price,
            'quantity' => $this->faker->randomNumber(1),
            'order_number' => $this->faker->randomNumber(8),
            'postcode' => $postcode,
            'address' => $address,
            'building' => $this->faker->secondaryAddress(),
        ];
    }
}
