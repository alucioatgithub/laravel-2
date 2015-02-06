<?php

use Faker\Factory as Faker;

class TagSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i <= 50; $i++) {

            \Survey\Tag::create([
                'title'         =>  $faker->streetName(),
                'description'   =>  $faker->sentences(),
                'graphics'      =>  array(
                    'background'    =>  '',
                    'icon'          =>  ''
                )
            ]);
        }
    }
}