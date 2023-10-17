<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Interface\QuestionInterface;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SubcategoryController extends Controller
{
    /**
     *
     * @param int $categoryId
     * @return JsonResponse|Response|ResponseFactory
     */
    public function findByCategoryId(int $categoryId): JsonResponse|Response|ResponseFactory
    {
        $subcategories = Subcategory::where(['category_id' => $categoryId])->get();
        $resultSubcategories = [];
        if (count($subcategories) > 0) {
            $formattedTypes = $subcategories->map(function (Subcategory $subcategory) {
                return [
                    'value' => $subcategory->id,
                    'label' => $subcategory->name,
                ];
            });
            $resultSubcategories = $formattedTypes->toArray();
        }
        return response()->json([
            'status' => true,
            'message' => $resultSubcategories
        ]);
    }
}
