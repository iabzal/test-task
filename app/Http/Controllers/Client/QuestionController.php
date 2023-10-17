<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Interface\QuestionInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class QuestionController extends Controller
{
    private QuestionInterface $questionRepository;

    /**
     * Undocumented function
     *
     * @param QuestionInterface $questionRepository
     */
    public function __construct(QuestionInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     *
     * @return Response|ResponseFactory
     */
    public function list(): Response|ResponseFactory
    {
        $result = $this->questionRepository->list();
        return inertia('Client/Request/Index', [
            'categories' => $result['categories'],
            'requestList' => $result['requestList'],
        ]);
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $this->questionRepository->create($request);
        return redirect()->route('client.request.list');
    }

}
