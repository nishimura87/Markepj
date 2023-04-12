<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'name' => $this->faker->name(),
            'kana' => $this->faker->kanaName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone_number' => $phone_number,
            'postcode' => $postcode,
            'address' => $address,
            'building' => $this->faker->secondaryAddress(),
            'stripe_id' => NULL,
            'role' => 'member',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
