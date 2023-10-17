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
        $requestList = Question::with('category')->with('subcategory')
            ->latest()->paginate(20);

        $requestList->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'message' => $item->message,
                'name' => $item->name,
                'category' => $item->category,
                'subcategory' => $item->subcategory,
                'created_at' => $item->created_at->format('d.m.Y H:i:s'),
                'status' => QuestionEnum::fromName($item->status),
            ];
        });

        return [
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


        $file = null;
        if ($request->file != null) {
            $file = Storage::disk('public')->put('uploads', $request->file('file'));
        }

        if ($request->subcategory_id) {
            Question::create([
                'title' => $request->title,
                'message' => $request->message,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'client_id' => $currentClientID,
                'file' => $file,
            ]);
        } else {
            Question::create([
                'title' => $request->title,
                'message' => $request->message,
                'category_id' => $request->category_id,
                'client_id' => $currentClientID,
                'file' => $file
            ]);
        }

        return true;
    }
}
