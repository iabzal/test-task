<?php

declare(strict_types=1);

namespace App\Http\Controllers\Client;

use App\Http\Interface\ClientInterface;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    private ClientInterface $clientRepository;

    /**
     * Undocumented function
     *
     * @param ClientInterface $clientRepository
     */
    public function __construct(ClientInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $this->clientRepository->registerClient($request);
        return redirect()->route('client.request.list');
    }
}
