<?php

declare(strict_types = 1);

namespace App\Http\Interface;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface AnswerInterface
{
    /**
     * @param Request $request
     * @param int $questionId
     * @return bool
     */
    public function createAnswer(Request $request, int $questionId): bool;
}
