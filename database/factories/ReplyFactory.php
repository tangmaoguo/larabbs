<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    //随机取一个月以内的时间
    $updated_at = $faker->dateTimeThisMonth;

    //传参为最大时间不超过
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'content'=>$sentence,
        'created_at'=>$created_at,
        'updated_at'=>$updated_at
    ];
});
