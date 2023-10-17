<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            "Ремонт оборудование",
            "Заявка на обслуживание",
            "Инцидент",
        ];
        foreach ($categories as $key => $categoryName) {
            Category::create([
                'id' => $key + 1,
                'name' => $categoryName,
            ]);
        }
    }
}
