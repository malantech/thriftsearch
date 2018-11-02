<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'yards' )->insert([
            [
                'id' => '1',
                'name' => 'The Malans',
                'address' => '10196 N Riverside Ln',
                'city' => 'Highland',
                'state' => 'UT',
                'zip' => '84003',
                'latitude' => '40.417175',
                'longitude' => '-111.79283',
                'description' => 'really cool stuff come see!',
                'created_at' => date("Y-m-d g:i:s"),
                'updated_at' => date("Y-m-d g:i:s")
            ],
            [
                'id' => '2',
                'name' => 'The Powells',
                'address' => '87 E 2200 N',
                'city' => 'Lehi',
                'state' => 'UT',
                'zip' => '84043',
                'latitude' => '40.415506',
                'longitude' => '-111.84801',
                'description' => 'really cool stuff come see!',
                'created_at' => date("Y-m-d g:i:s"),
                'updated_at' => date("Y-m-d g:i:s")
            ]
        ]);

        DB::table( 'yards_types' )->insert([
                [
                    'id' => '1',
                    'name' => 'Garage',
                    'description' => 'Choose this if your sale is inside your garage.',
                    'created_at' => date("Y-m-d g:i:s"),
                    'updated_at' => date("Y-m-d g:i:s")
                ],
                [
                    'id' => '2',
                    'name' => 'Yard',
                    'description' => 'Pick this if your sale is on your front lawn.',
                    'created_at' => date("Y-m-d g:i:s"),
                    'updated_at' => date("Y-m-d g:i:s")
                ],
                [
                    'id' => '3',
                    'name' => 'Park',
                    'description' => 'This option is for sales in a park like a multi-family.',
                    'created_at' => date("Y-m-d g:i:s"),
                    'updated_at' => date("Y-m-d g:i:s")
                ],
                [
                    'id' => '4',
                    'name' => 'Lot',
                    'description' => 'I am located in a parking lot somewhere.',
                    'created_at' => date("Y-m-d g:i:s"),
                    'updated_at' => date("Y-m-d g:i:s")
                ],
                [
                    'id' => '5',
                    'name' => 'Business',
                    'description' => 'I do this regularly at a place of business so select me.',
                    'created_at' => date("Y-m-d g:i:s"),
                    'updated_at' => date("Y-m-d g:i:s")
                ],
                [
                    'id' => '6',
                    'name' => 'Estate',
                    'description' => 'Everything goes! Make this your choice if you are blowing it all out!',
                    'created_at' => date("Y-m-d g:i:s"),
                    'updated_at' => date("Y-m-d g:i:s")
                ]
            ]

        );

        DB::table( 'saved_yards_types' )->insert([
                [
                    'yard_id' => '1',
                    'yards_types_id' => '2'
                ],
                [
                    'yard_id' => '2',
                    'yards_types_id' => '2'
                ]
            ]
        );
    }
}