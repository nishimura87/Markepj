<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AddresseeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fakePhonenumber = $this->faker->phoneNumber();
        $phone_number = str_replace("-","",$fakePhonenumber);

        $fakePostcode = $this->faker->postcode();
        $post1 = substr($fakePostcode ,0,3);
        $post2 = substr($fakePostcode ,3);
        $postcode = $post1 . "-" . $post2;

        $fakeAddress =$this->faker->address();
        $address = substr($fakeAddress, 9);
        
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'kana' => $this->faker->kanaName(),
            'phone_number' => $phone_number,
            'postcode' => $postcode,
            'address' => $address,
            'building' => $this->faker->secondaryAddress(),
        ];
    }
}
