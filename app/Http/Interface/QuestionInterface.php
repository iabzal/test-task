<?php

declare(strict_types = 1);

namespace App\Http\Interface;

use Illuminate\Http\Request;

interface QuestionInterface
{
    /**
     *
     * @return array
     */
    public function list(): array;

    public function create(Request $request): bool;
}
