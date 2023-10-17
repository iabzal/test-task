<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            1 => ["Компьютер", "Ноутбук", "Телефон"],
            2 => ["Принтер", "Компьютер", "Ноутбук"],
            3 => ["Ноутбук не работает", "Монитор не работает"],
        ];

        foreach ($categories as $categoryId => $subcategories) {
            foreach ($subcategories as $subcategoryName) {
                Subcategory::create([
                    'name' => $subcategoryName,
                    'category_id' => $categoryId,
                ]);
            }
        }
    }
}
