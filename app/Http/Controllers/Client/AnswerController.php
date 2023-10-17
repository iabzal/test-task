<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Interface\AnswerInterface;
use App\Models\Answer;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AnswerController extends Controller
{
    private AnswerInterface $answerRepository;

    public function __construct(AnswerInterface $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

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


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findByParam(Request $request): JsonResponse
    {
        return response()->json($this->answerRepository->findByParam($request));
    }
}
