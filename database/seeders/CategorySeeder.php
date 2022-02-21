<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {
    public function run() {
        $categories = ["Informática", "Saúde", "Natureza", "Ciência", "Matemática"];
        foreach ($categories as $cat){
            DB::table('categories')->insert(['name' => $cat]);
        }
    }
}
