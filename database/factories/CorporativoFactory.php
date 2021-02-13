<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Corporativo;
use App\User;
use Faker\Generator as Faker;

$factory->define(Corporativo::class, function (Faker $faker) {
    return [
        'S_NombreCorto' => $faker->word,
        'S_NombreCompleto' => $faker->company,
        'S_LogoURL' => $faker->imageUrl($width = 640, $height = 480),
        'S_DBName' => $faker->domainWord,
        'S_DBUsuario' => $faker->userName,
        'S_DBPassword' => $faker->password,
        'S_SystemUrl' => $faker->url,
        'usuarios_id' => $faker->numberBetween(1, User::count()),
        'D_FechaIncorporacion' => date('Y-m-d H:i:s')
    ];
});
