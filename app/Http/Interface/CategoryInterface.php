<?php

declare(strict_types = 1);

namespace App\Http\Interface;

interface CategoryInterface
{
    /**
     *
     * @return array
     */
    public function list(): array;
}
