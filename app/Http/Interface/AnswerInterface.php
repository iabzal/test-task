<?php

declare(strict_types = 1);

namespace App\Http\Interface;

use App\Models\Answer;
use Illuminate\Http\Request;

interface AnswerInterface
{
    /**
     * @param Request $request
     * @param int $questionId
     * @return bool
     */
    public function createAnswer(Request $request, int $questionId): bool;

    /**
     * @param Request $request
     * @return Answer|null
     */
    public function findByParam(Request $request): ?Answer;
}
