<?php

declare(strict_types = 1);

namespace App\Http\Interface;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface QuestionInterface
{
    /**
     *
     * @return array
     */
    public function list(): array;

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool;

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function findById(int $id): Model|Collection|Builder|array;

    /**
     * @param int $questionId
     * @param string $status
     * @return mixed
     */
    public function updateStatus(int $questionId, string $status): bool;
}
