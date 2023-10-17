<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Enums\QuestionEnum;
use App\Http\Interface\QuestionInterface;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
        $questionList = Question::with('category')->with('subcategory')
            ->latest()->paginate(20);

        $questionList->getCollection()->transform(function ($item) {
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
            'questionList' => $questionList,
        ];
    }

    /**
     * @param int $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function findById(int $id): Model|Collection|Builder|array
    {
        return Question::with('category')->with('subcategory')->findOrFail($id);
    }

    /**
     *
     * @param Request $request
     * @return bool|array
     */
    public function create(Request $request): bool|array
    {
        $currentClientID = auth()->guard('client')->user()->id;
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'nullable|integer',
            'file' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx',
        ]);
        $lastRequest = Question::where(['client_id' => $currentClientID])
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastRequest) {
            $timeSinceLastRequest = now()->diffInHours($lastRequest->created_at);
            if ($timeSinceLastRequest < 24) {
                return [
                    'error' => "Вы уже создали заявку на сегодня."
                ];
            }
        }

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

    /**
     * @param int $questionId
     * @param string $status
     * @return bool
     */
    public function updateStatus(int $questionId, string $status): bool
    {
        $question = Question::findOrFail($questionId);
        $question->update([
            'status' => $status,
        ]);
        return true;
    }
}
