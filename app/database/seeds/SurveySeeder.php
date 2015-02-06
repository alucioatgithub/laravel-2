<?php

use Faker\Factory as Faker;

class SurveySeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i <= 50; $i++) {

            \Survey\Survey::create([
                'type'          => 'type',
                'tags'          => array(),
                'author'        => uniqid(),
                'information'   => $faker->sentence(),
                'targeting'     => array()
            ]);
        }
    }
}