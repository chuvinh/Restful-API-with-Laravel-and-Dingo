<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();

        $cities = [
            'Kolkata',
            'Koblenz',
            'London',
            'Paris'
        ];

        foreach($cities as $city)
        {
            \App\Models\City::firstOrCreate([
                'name'  =>  $city,
            ]);
        }

        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
