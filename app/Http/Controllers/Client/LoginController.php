<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'login'      => 'required',
            'password'  => 'required',
        ]);

        $client = Client::where([
            'login'      => $request->login,
            'password'  => $request->password
        ])->first();

        if(!$client) {
            return redirect()->back()->with('error', 'Неправильный логин или пароль');
        }

        auth()->guard('client')->login($client);

        return redirect()->route('client.tests');
    }
}
