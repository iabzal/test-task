<?php

declare(strict_types = 1);

namespace App\Http\Interface;

use Illuminate\Http\Request;

interface ClientInterface
{
    /**
     *
     * @param Request $request
     *
     * @return bool
     */
    public function registerClient(Request $request): bool;
}
