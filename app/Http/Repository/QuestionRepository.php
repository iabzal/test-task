<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Enums\QuestionEnum;
use App\Http\Interface\QuestionInterface;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionRepository implements QuestionInterface
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
        $requestList = Question::with('category')
            ->latest()->paginate(20);

        $requestList->getCollection()->transform(function ($item) {
            return [
                'title' => $item->title,
                'name' => $item->name,
                'category' => $item->category,
                'created_at' => $item->created_at->format('d.m.Y H:i:s'),
                'status' => QuestionEnum::fromName($item->status),
            ];
        });

        return [
            'categories' => $resultCategories,
            'requestList' => $requestList,
        ];
    }

    /**
     *
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool
    {
        $currentClientID = auth()->guard('client')->user()->id;
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx',
        ]);

        if ($request->subcategory_id) {
            Question::create([
                'title' => $request->title,
                'message' => $request->message,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'client_id' => $currentClientID,
            ]);
        } else {
            Question::create([
                'title' => $request->title,
                'message' => $request->message,
                'category_id' => $request->category_id,
                'client_id' => $currentClientID,
            ]);
        }

        if ($request->file != null) {
            Storage::disk('public')->put('uploads', $request->file('file'));
        }

        return true;
    }
}
