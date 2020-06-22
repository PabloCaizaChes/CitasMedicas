<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => str_random(10),
        'cedula'=>$faker->randomNumber(9,true),
        'address'=>$faker->address,
        'phone'=>$faker->e164PhoneNumber,
        'role'=>$faker->randomElement(['doctor','patient'])

    ];


});
      $factory->state(App\User::class, 'doctor',[
        'role' => 'doctor'

]);
$factory -> state(App\User::class, 'patient',[
        'role' => 'patient' 

]);