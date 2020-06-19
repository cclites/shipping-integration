<?php

namespace App\Libraries;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Factory as Faker;

class ItemsFactory{

    public static function createItems(){
        $faker = Faker::create();

        return [
            'name' => $faker->name,
            'company' => $faker->company,
            'street1'=> $faker->streetAddress,
            'street2'=> $faker->secondaryAddress,
            'street3' => '',
            'city'=> $faker->city,
            'state'=>$faker->state,
            'postalCode' => $faker->postcode,
            'country' => 'US',
            'phone' => $faker->phoneNumber,
        ];
    }
}
