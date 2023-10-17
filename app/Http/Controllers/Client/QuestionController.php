<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Interface\CategoryInterface;
use App\Http\Interface\QuestionInterface;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class QuestionController extends Controller
{
    private QuestionInterface $questionRepository;
    private CategoryInterface $categoryRepository;

    /**
     * Undocumented function
     *
     * @param QuestionInterface $questionRepository
     * @param CategoryInterface $categoryRepository
     */
    public function __construct(QuestionInterface $questionRepository, CategoryInterface $categoryRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     *
     * @return Response|ResponseFactory
     */
    public function list(): Response|ResponseFactory
    {
        $categories = $this->categoryRepository->list();
        $result = $this->questionRepository->list();
        return inertia('Client/Question/Index', [
            'categories' => $categories,
            'questionList' => $result['questionList'],
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
