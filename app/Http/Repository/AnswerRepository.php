<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Enums\QuestionEnum;
use App\Http\Interface\AnswerInterface;
use App\Http\Interface\QuestionInterface;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnswerRepository implements AnswerInterface
{
    /**
     *
     * @param Request $request
     * @param int $questionId
     * @return bool
     */
    public function createAnswer(Request $request, int $questionId): bool
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        Answer::create([
            'question_id' => $questionId,
            'answer' => $request->answer,
        ]);

        return true;
    }
}
