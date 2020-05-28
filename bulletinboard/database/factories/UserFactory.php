<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' =>'1',
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => '$2y$12$QbDu1X.nhAzO1M2ynNtW3uyjkuPSi09VijhQUkGGgbcvpm87U/1ju', // password
        'profile' => Str::random(10).'.jpg',
        'type' => 0,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'dob' => $faker->date,
        'create_user_id' => 1,
        'updated_user_id' => 1,
        'created_at'=> now(),
        'updated_at'=> now(),
    ];
});
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'description' => $faker->text($maxNbChars = 100),
        'status' => 1,
        'create_user_id' => 1,
        'updated_user_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
