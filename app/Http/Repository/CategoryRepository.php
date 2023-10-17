<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Interface\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    /**
     *
     * @return array
     */
    public function list(): array
    {
        $categories = Category::all();
        $resultCategories = [];
        if (count($categories) > 0) {
            $formattedCategories = $categories->map(function (Category $category) {
                return [
                    'value' => $category->id,
                    'label' => $category->name,
                ];
            });
            $resultCategories = $formattedCategories->toArray();
        }
        return $resultCategories;
    }
}
