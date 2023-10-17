<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Enums\QuestionEnum;
use App\Http\Controllers\Controller;
use App\Http\Interface\AnswerInterface;
use App\Http\Interface\QuestionInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class QuestionController extends Controller
{
    private QuestionInterface $questionRepository;

    private AnswerInterface $answerRepository;

    /**
     * Undocumented function
     *
     * @param QuestionInterface $questionRepository
     * @param AnswerInterface $answerRepository
     */
    public function __construct(QuestionInterface $questionRepository, AnswerInterface $answerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    /**
     *
     * @return Response|ResponseFactory
     */
    public function list(): Response|ResponseFactory
    {
        $result = $this->questionRepository->list();
        return inertia('Admin/Question/Index', [
            'questionList' => $result['questionList'],
        ]);
    }

    /**
     *
     * @param int $id
     * @return Response|ResponseFactory
     */
    public function findById(int $id): Response|ResponseFactory
    {
        return inertia('Admin/Answer/Index', [
            'question' => $this->questionRepository->findById($id),
        ]);
    }

    /**
     *
     * @param Request $request
     * @param int $questionId
     * @return RedirectResponse
     */
    public function answer(Request $request, int $questionId): RedirectResponse
    {
        if ($this->answerRepository->createAnswer($request, $questionId)) {
            $this->questionRepository->updateStatus($questionId, QuestionEnum::answered->name);
        }
        return redirect()->route('admin.questions');
    }

}
