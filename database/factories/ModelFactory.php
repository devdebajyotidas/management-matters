<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => 'secret',
        'account_id' => 0,
        'account_type' =>'',
        'remember_token' => str_random(10),
        'api_token' => str_random(60)
    ];
});

$factory->define(App\Models\Learner::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber
    ];
});

$factory->define(App\Models\Organization::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'contact_person' => $faker->name
    ];
});

$factory->define(App\Models\Learning::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->monthName,
        'description' => $faker->realText(),
        'highlights' => [$faker->realText(20),$faker->realText(20),$faker->realText(15),$faker->realText(20)],
        'chapters' => [
            [
                'name' => $faker->firstName,
                'content' => $faker->realText()
            ],
            [
                'name' => $faker->firstName,
                'content' => $faker->realText()
            ],
            [
                'name' => $faker->firstName,
                'content' => $faker->realText()
            ]
        ],
        'assessments' => [
            $faker->realText(50),
            $faker->realText(50),
            $faker->realText(50),
        ],
        'quiz' => [
            [
                'question' => $faker->sentence()." ?",
                'content'=>[
                    [
                        'answer' => $faker->sentence(),'type' => 'false','note' => $faker->text($maxNbChars = 100)
                    ],
                    [
                        'answer' => $faker->sentence(),'type' => 'false','note' => $faker->text($maxNbChars = 100)
                    ],
                    [
                        'answer' => $faker->sentence(),'type' => 'false','note' => $faker->text($maxNbChars = 100)
                    ],
                    [
                        'answer' => $faker->sentence(),'type' => 'true','note' => $faker->text($maxNbChars = 100)
                    ]
                ]
            ],
            [
                'question' => $faker->sentence()." ?",
                'content'=>[
                    [
                        'answer' => $faker->sentence(),'type' => 'false','note' => $faker->text($maxNbChars = 100)
                    ],
                    [
                        'answer' => $faker->sentence(),'type' => 'false','note' => $faker->text($maxNbChars = 100)
                    ],
                    [
                        'answer' => $faker->sentence(),'type' => 'false','note' => $faker->text($maxNbChars = 100)
                    ],
                    [
                        'answer' => $faker->sentence(),'type' => 'true','note' => $faker->text($maxNbChars = 100)
                    ]
                ]
            ]
        ],
        'total_questions'=>'2'
    ];
});

//$factory->define(App\Models\Assessment::class, function (Faker\Generator $faker) {
//    return [
//        'learning_id' => $faker->numberBetween(1,10),
//        'statement' => $faker->realText(50)
//    ];
//});

$factory->define(App\Models\Department::class, function (Faker\Generator $faker) {
    return [
        'organization_id' => rand(1,10),
        'name' => $faker->firstName
    ];
});
