<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $category = [
            ['name' => 'Johor', 'country' => 'Malaysia'], ['name' => 'Kedah', 'country' => 'Malaysia'], ['name' => 'Kelantan', 'country' => 'Malaysia'],
            ['name' => 'Labuan', 'country' => 'Malaysia'], ['name' => 'Malacca', 'country' => 'Malaysia'], ['name' => 'Negeri Sembilan', 'country' => 'Malaysia'],
            ['name' => 'Pahang', 'country' => 'Malaysia'], ['name' => 'Perak', 'country' => 'Malaysia'], ['name' => 'Perlis', 'country' => 'Malaysia'],
            ['name' => 'Pulau Pinang', 'country' => 'Malaysia'], ['name' => 'Sabah', 'country' => 'Malaysia'], ['name' => 'Sarawak', 'country' => 'Malaysia'],
            ['name' => 'Selangor', 'country' => 'Malaysia'], ['name' => 'Terengganu', 'country' => 'Malaysia'], ['name' => 'Wilayah Persekutuan', 'country' => 'Malaysia'],
        ];
        State::insert($category);
    }

}
