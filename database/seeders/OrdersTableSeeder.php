<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Model;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=10; $i++){
            $user = User::inRandomOrder()->first();
            Order::factory()->count(1)->create()->each(function (Order $order) use ($user) {
                $order->users()->attach(
                $user);
            });
        }
    }
}
