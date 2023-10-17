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
use Nette\Schema\ValidationException;

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
        $result = $this->questionRepository->list();
        return inertia('Client/Question/Index', [
            'questionList' => $result['questionList'],
        ]);
    }

    /**
     *
     * @return Response|ResponseFactory
     */
    public function add(): Response|ResponseFactory
    {
        $categories = $this->categoryRepository->list();
        return inertia('Client/Question/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request): RedirectResponse
    {
        $result = $this->questionRepository->create($request);
        if (is_array($result)) {
            if (isset($result['error'])) {
                return redirect()->back()->withErrors([
                    'hasQuestion' => $result['error']
                ]);
            }
        }
        return redirect()->route('client.request.list');
    }

}
