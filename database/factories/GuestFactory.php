<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Guest::class, function (Faker $faker) {

    return [
        'name'=>$faker->name(),
        'company'=>"Group 7 corporation",
        'status'=>1,
        'amgros_employee'=>$faker->firstName(),
        'created_at'=>$faker->dateTimeBetween('now', '+0 days'),
        'updated_at'=> null,
        'time_created'=>$faker->date('H:i:s', rand(1,54000)),
    ];
});
