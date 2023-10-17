<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Test;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function __invoke(Request $request): Response|ResponseFactory
    {
        $clients = Client::count();

        return inertia('Admin/Dashboard/Index', [
            'clients' => $clients,
        ]);
    }
}
