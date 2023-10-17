<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{

    /**
     * toResponse
     *
     * @param  mixed $request
     * @return Application|RedirectResponse|Redirector
     */
    public function toResponse($request): Redirector|RedirectResponse|Application
    {
        return redirect('/');
    }
}
