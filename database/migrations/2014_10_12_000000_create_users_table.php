<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kana');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('postcode');
            $table->string('address');
            $table->string('building')->nullable();
            $table->string('phone_number',20);
            $table->string('stripe_id')->unique()->nullable();
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'id' => NULL,
            'name' => 'Admin',
            'kana' => 'アドミン',
            'email' => 'marke.b.2023@gmail.com',
            'email_verified_at' => NULL,
            'password' => \Hash::make('admin2023'),
            'postcode' => '105-0011',
            'address' => '東京都港区芝公園4-8-4',
            'phone_number' => '08012341234',
            'building' => NULL,
            'stripe_id' => NULL,
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
