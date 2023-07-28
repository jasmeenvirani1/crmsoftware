<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MerchantCategory;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $category = [
            ['name' => 'Automotive'], ['name' => 'Baby & Toddler'], ['name' => 'Clothing & Shoes'],
            ['name' => 'Computers'], ['name' => 'Electronics'], ['name' => 'Entertainment & Arts'],
            ['name' => 'Food & Gifts'], ['name' => 'Health & Beauty'], ['name' => 'Home & Garden'],
            ['name' => 'Office & Professional Services'], ['name' => 'Personal & Home Services'], ['name' => 'Restaurants & Dining'],
            ['name' => 'Software'], ['name' => 'Sports & Outdoors'], ['name' => 'Travel'],
        ];
        MerchantCategory::insert($category);
    }

}
